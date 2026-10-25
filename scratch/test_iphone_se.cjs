const { spawn } = require('child_process');
const http = require('http');
const fs = require('fs');
const path = require('path');

const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const url = 'http://127.0.0.1:8000/preview/templates/wedding-01';

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

function checkServer() {
    return new Promise((resolve) => {
        const req = http.get(url, res => {
            resolve(res.statusCode === 200);
        });
        req.on('error', () => resolve(false));
        req.setTimeout(1500, () => {
            req.destroy();
            resolve(false);
        });
    });
}

function getJson(u) {
    return new Promise((resolve, reject) => {
        http.get(u, res => {
            let d = '';
            res.on('data', c => d += c);
            res.on('end', () => resolve(JSON.parse(d)));
        }).on('error', reject);
    });
}

(async () => {
    let phpProcess = null;
    const isRunning = await checkServer();
    if (!isRunning) {
        console.log('Starting PHP development server...');
        phpProcess = spawn('php', ['artisan', 'serve', '--port=8000'], {
            cwd: path.join(__dirname, '..'),
            stdio: 'ignore'
        });
        for (let i = 0; i < 20; i++) {
            await sleep(500);
            if (await checkServer()) {
                console.log('PHP server is up on port 8000');
                break;
            }
        }
    } else {
        console.log('PHP server already running.');
    }

    const userDataDir = path.join(__dirname, 'chrome_se_' + Date.now());
    const port = 9555;
    const chrome = spawn(chromePath, [
        '--headless=new',
        '--disable-gpu',
        '--no-sandbox',
        `--remote-debugging-port=${port}`,
        `--user-data-dir=${userDataDir}`,
        '--window-size=375,667',
        url
    ]);

    await sleep(2500);
    const targets = await getJson(`http://127.0.0.1:${port}/json`);
    const pageTarget = targets.find(t => t.type === 'page');
    const ws = new WebSocket(pageTarget.webSocketDebuggerUrl);

    let msgId = 1;
    function send(method, params = {}) {
        return new Promise((resolve) => {
            const id = msgId++;
            const listener = (event) => {
                const data = JSON.parse(event.data);
                if (data.id === id) {
                    ws.removeEventListener('message', listener);
                    resolve(data.result);
                }
            };
            ws.addEventListener('message', listener);
            ws.send(JSON.stringify({ id, method, params }));
        });
    }

    await new Promise(r => ws.addEventListener('open', r));
    await send('Page.enable');
    await send('Runtime.enable');
    await send('Emulation.setDeviceMetricsOverride', {
        width: 375,
        height: 667,
        deviceScaleFactor: 2,
        mobile: true
    });

    await sleep(2500);

    // 1. Cover on iPhone SE
    const coverSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 90 });
    fs.writeFileSync(path.join(__dirname, 'test_se_cover.jpg'), Buffer.from(coverSnap.data, 'base64'));
    console.log('Saved test_se_cover.jpg');

    // 2. Open Invitation to see Hero
    await send('Runtime.evaluate', { expression: `openDutchInvitation();` });
    await sleep(2000);

    const heroSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 90 });
    fs.writeFileSync(path.join(__dirname, 'test_se_hero.jpg'), Buffer.from(heroSnap.data, 'base64'));
    console.log('Saved test_se_hero.jpg');

    ws.close();
    chrome.kill();
    if (phpProcess) {
        phpProcess.kill();
    }
    process.exit(0);
})();
