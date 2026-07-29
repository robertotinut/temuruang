// Edit data utama undangan di sini.
const invitationDate = new Date('2026-09-21T08:00:00+07:00');
const cover = document.getElementById('cover');
const openBtn = document.getElementById('openBtn');
const menuBtn = document.getElementById('menuBtn');
const menuPanel = document.getElementById('menuPanel');

openBtn?.addEventListener('click', () => {
  cover.classList.add('is-open');
  setTimeout(() => window.scrollTo({ top: 0, behavior: 'smooth' }), 250);
});

menuBtn?.addEventListener('click', () => {
  menuPanel.classList.toggle('is-show');
});

document.querySelectorAll('.menu-panel a, .bottom-nav a').forEach(link => {
  link.addEventListener('click', () => menuPanel.classList.remove('is-show'));
});

function pad(num){ return String(num).padStart(2,'0'); }
function updateCountdown(){
  const now = new Date();
  let diff = invitationDate - now;
  if(diff < 0) diff = 0;
  const d = Math.floor(diff / (1000*60*60*24));
  const h = Math.floor((diff / (1000*60*60)) % 24);
  const m = Math.floor((diff / (1000*60)) % 60);
  const s = Math.floor((diff / 1000) % 60);
  document.getElementById('days').textContent = pad(d);
  document.getElementById('hours').textContent = pad(h);
  document.getElementById('minutes').textContent = pad(m);
  document.getElementById('seconds').textContent = pad(s);
}
updateCountdown();
setInterval(updateCountdown, 1000);
