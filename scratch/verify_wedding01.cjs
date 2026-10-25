const { spawn } = require('child_process');
const http = require('http');
const fs = require('fs');
const path = require('path');

const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const url = 'http://127.0.0.1:8000/preview/templates/wedding-01';
const outThumb = path.join(__dirname, '..', 'storage', 'app', 'public', 'templates', 'thumbnails', 'wedding-01.jpg');
const pubThumb = path.join(__dirname, '..', 'public', 'storage', 'templates', 'thumbnails', 'wedding-01.jpg');

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

    const userDataDir = path.join(__dirname, 'chrome_w01_' + Date.now());
    const port = 9444;
    const chrome = spawn(chromePath, [
        '--headless=new',
        '--disable-gpu',
        '--no-sandbox',
        `--remote-debugging-port=${port}`,
        `--user-data-dir=${userDataDir}`,
        '--window-size=430,760',
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
        width: 430,
        height: 760,
        deviceScaleFactor: 2,
        mobile: true
    });

    await sleep(3000);

    // 1. Capture Cover Thumbnail
    const coverSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 90 });
    const coverBuf = Buffer.from(coverSnap.data, 'base64');
    fs.writeFileSync(outThumb, coverBuf);
    if (fs.existsSync(path.dirname(pubThumb))) {
        fs.writeFileSync(pubThumb, coverBuf);
    }
    fs.writeFileSync(path.join(__dirname, 'wedding01_cover_snap.jpg'), coverBuf);
    console.log('Saved cover thumbnail:', outThumb);

    // 2. Click Open Invitation
    await send('Runtime.evaluate', { expression: `openDutchInvitation();` });
    await sleep(1800);

    const heroSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 88 });
    fs.writeFileSync(path.join(__dirname, 'wedding01_hero_snap.jpg'), Buffer.from(heroSnap.data, 'base64'));
    console.log('Saved hero snapshot');

    // 3. Scroll to Quote Section
    await send('Runtime.evaluate', {
        expression: `window.scrollTo({ top: 600, behavior: 'instant' });`
    });
    await sleep(800);
    const quoteSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 88 });
    fs.writeFileSync(path.join(__dirname, 'wedding01_quote_snap.jpg'), Buffer.from(quoteSnap.data, 'base64'));
    console.log('Saved quote snapshot');

    // 4. Scroll to Couple Section
    await send('Runtime.evaluate', {
        expression: `document.getElementById('coupleSection').scrollIntoView({ behavior: 'instant' });`
    });
    await sleep(800);
    const coupleSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 88 });
    fs.writeFileSync(path.join(__dirname, 'wedding01_couple_snap.jpg'), Buffer.from(coupleSnap.data, 'base64'));
    console.log('Saved couple snapshot');

    // 5. Scroll to Event Section
    await send('Runtime.evaluate', {
        expression: `document.getElementById('eventSection').scrollIntoView({ behavior: 'instant' });`
    });
    await sleep(800);
    const eventSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 88 });
    fs.writeFileSync(path.join(__dirname, 'wedding01_event_snap.jpg'), Buffer.from(eventSnap.data, 'base64'));
    console.log('Saved event snapshot');

    // 6. Scroll to Footer Section
    await send('Runtime.evaluate', {
        expression: `window.scrollTo({ top: document.body.scrollHeight, behavior: 'instant' });`
    });
    await sleep(800);
    const footerSnap = await send('Page.captureScreenshot', { format: 'jpeg', quality: 88 });
    fs.writeFileSync(path.join(__dirname, 'wedding01_footer_snap.jpg'), Buffer.from(footerSnap.data, 'base64'));
    console.log('Saved footer snapshot');

    ws.close();
    chrome.kill();
    if (phpProcess) {
        phpProcess.kill();
    }
    console.log('Verification finished successfully.');
    process.exit(0);
})();
