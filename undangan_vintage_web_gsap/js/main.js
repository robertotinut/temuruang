const stage = document.getElementById('stage');
const openGate = document.getElementById('openGate');
const musicDisc = document.getElementById('musicDisc');
const weddingAudio = document.getElementById('weddingAudio');
const pieces = [...document.querySelectorAll('.piece')];
let opened = false;
let musicOn = false;
let audioCtx = null;
let fallbackOscillator = null;

function randomBetween(min, max) {
  return Math.random() * (max - min) + min;
}

function playFallbackPad() {
  if (!audioCtx) {
    audioCtx = new (window.AudioContext || window.webkitAudioContext)();
  }

  if (fallbackOscillator) {
    fallbackOscillator.stop();
    fallbackOscillator = null;
    return;
  }

  const gain = audioCtx.createGain();
  gain.gain.setValueAtTime(0.0001, audioCtx.currentTime);
  gain.gain.exponentialRampToValueAtTime(0.035, audioCtx.currentTime + 0.8);
  gain.connect(audioCtx.destination);

  const osc = audioCtx.createOscillator();
  osc.type = 'sine';
  osc.frequency.setValueAtTime(392, audioCtx.currentTime);
  osc.frequency.linearRampToValueAtTime(523.25, audioCtx.currentTime + 4);
  osc.connect(gain);
  osc.start();
  fallbackOscillator = osc;
}

function animateWithGsap() {
  const stageRect = stage.getBoundingClientRect();
  const startX = stageRect.width / 2;
  const startY = stageRect.height + 120;

  pieces.forEach((el) => {
    const rect = el.getBoundingClientRect();
    const localCenterX = rect.left - stageRect.left + rect.width / 2;
    const localCenterY = rect.top - stageRect.top + rect.height / 2;

    gsap.set(el, {
      x: startX - localCenterX + randomBetween(-18, 18),
      y: startY - localCenterY + randomBetween(0, 80),
      scale: randomBetween(0.58, 0.74),
      opacity: 0,
      rotate: randomBetween(-13, 13),
      transformOrigin: 'center center'
    });
  });

  const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

  tl.to(openGate, {
    duration: 0.45,
    opacity: 0,
    scale: 0.78,
    pointerEvents: 'none',
    ease: 'power2.inOut'
  })
  .to('.envelope', {
    x: 0,
    y: 0,
    opacity: 1,
    scale: 1,
    rotate: 0,
    duration: 1.05,
    ease: 'back.out(1.4)'
  }, '-=0.08')
  .to(['.flower-left', '.flower-right'], {
    x: 0,
    y: 0,
    opacity: 1,
    scale: 1,
    rotate: 0,
    duration: 1.2,
    stagger: 0.15,
    ease: 'back.out(1.65)'
  }, '-=0.58')
  .to(['.portrait-wrap', '.name-card'], {
    x: 0,
    y: 0,
    opacity: 1,
    scale: 1,
    rotate: 0,
    duration: 1.05,
    stagger: 0.13,
    ease: 'back.out(1.4)'
  }, '-=0.55')
  .to(['.date-card', '.music-disc', '.hydrangea', '.butterfly'], {
    x: 0,
    y: 0,
    opacity: 1,
    scale: 1,
    rotate: 0,
    duration: 1.05,
    stagger: 0.11,
    ease: 'back.out(1.55)'
  }, '-=0.45')
  .add(startFloating, '>-0.1');
}

function startFloating() {
  if (!window.gsap) return;

  gsap.to('.float-slow', {
    y: '-=8',
    duration: 4.2,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
  });

  gsap.to('.float-medium', {
    y: '-=11',
    x: '+=2',
    duration: 3.2,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
  });

  gsap.to('.float-soft', {
    y: '+=7',
    rotate: '+=1.2',
    duration: 3.7,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
  });

  gsap.to('.float-card', {
    y: '-=5',
    duration: 4.6,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
  });

  gsap.to('.float-butterfly', {
    x: '-=13',
    y: '+=9',
    rotate: '-=7',
    duration: 2.7,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut'
  });
}


function animateWithoutGsap() {
  const stageRect = stage.getBoundingClientRect();
  const startX = stageRect.width / 2;
  const startY = stageRect.height + 120;

  openGate.animate([
    { opacity: 1, transform: 'translate(-50%, -50%) scale(1)' },
    { opacity: 0, transform: 'translate(-50%, -50%) scale(.78)' }
  ], { duration: 420, easing: 'ease-in-out', fill: 'forwards' });
  openGate.style.pointerEvents = 'none';

  pieces.forEach((el, index) => {
    const rect = el.getBoundingClientRect();
    const localCenterX = rect.left - stageRect.left + rect.width / 2;
    const localCenterY = rect.top - stageRect.top + rect.height / 2;
    const x = startX - localCenterX + randomBetween(-18, 18);
    const y = startY - localCenterY + randomBetween(0, 80);
    const r = randomBetween(-13, 13);
    const delay = 260 + index * 95;

    el.style.opacity = '1';
    el.animate([
      { transform: `translate(${x}px, ${y}px) scale(.66) rotate(${r}deg)`, opacity: 0 },
      { transform: 'translate(0, 0) scale(1) rotate(0deg)', opacity: 1 }
    ], {
      duration: 1050,
      delay,
      easing: 'cubic-bezier(.18,.86,.26,1.12)',
      fill: 'both'
    });
  });
}

function openInvitation() {
  if (opened) return;
  opened = true;

  if (window.gsap) {
    animateWithGsap();
  } else {
    animateWithoutGsap();
    openGate.setAttribute('aria-hidden', 'true');
  }
}

async function toggleMusic() {
  musicOn = !musicOn;
  musicDisc.classList.toggle('is-playing', musicOn);

  try {
    if (musicOn) {
      await weddingAudio.play();
    } else {
      weddingAudio.pause();
    }
  } catch (error) {
    playFallbackPad();
  }
}

function initFallbackState() {
  if (!window.gsap) {
    pieces.forEach((el) => { el.style.opacity = '0'; });
  } else {
    gsap.set(pieces, { opacity: 0 });
  }
}

openGate.addEventListener('click', openInvitation);
musicDisc.addEventListener('click', toggleMusic);
window.addEventListener('load', initFallbackState);

// Click anywhere on the stage also opens the invitation, but buttons keep their own behavior.
stage.addEventListener('click', (event) => {
  if (!opened && !event.target.closest('button')) {
    openInvitation();
  }
});
