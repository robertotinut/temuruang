const openBtn = document.getElementById('openBtn');
const coverScreen = document.getElementById('coverScreen');
const navToggle = document.getElementById('navToggle');
const quickNav = document.getElementById('quickNav');
const invitationDate = new Date('2026-09-21T08:00:00+07:00');

openBtn?.addEventListener('click', () => {
  coverScreen.classList.add('is-open');
  setTimeout(() => window.scrollTo({ top: 0, behavior: 'smooth' }), 250);
});

navToggle?.addEventListener('click', () => {
  quickNav.classList.toggle('show');
});

document.querySelectorAll('.quick-nav a').forEach(link => {
  link.addEventListener('click', () => quickNav.classList.remove('show'));
});

document.addEventListener('click', (e) => {
  if (!quickNav.contains(e.target) && e.target !== navToggle) {
    quickNav.classList.remove('show');
  }
});

function pad(num){
  return String(num).padStart(2,'0');
}

function updateCountdown(){
  const now = new Date();
  let diff = invitationDate - now;
  if (diff < 0) diff = 0;
  const d = Math.floor(diff / (1000 * 60 * 60 * 24));
  const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
  const m = Math.floor((diff / (1000 * 60)) % 60);
  const s = Math.floor((diff / 1000) % 60);
  document.getElementById('days').textContent = pad(d);
  document.getElementById('hours').textContent = pad(h);
  document.getElementById('minutes').textContent = pad(m);
  document.getElementById('seconds').textContent = pad(s);
}
updateCountdown();
setInterval(updateCountdown, 1000);

document.getElementById('calendarBtn')?.addEventListener('click', () => {
  const start = '20260921T010000Z';
  const end = '20260921T040000Z';
  const text = encodeURIComponent('Wedding Virga & Bersly');
  const details = encodeURIComponent('Akad & Resepsi Virga dan Bersly');
  const location = encodeURIComponent('Sidoarjo, Jawa Timur');
  window.open(`https://calendar.google.com/calendar/render?action=TEMPLATE&text=${text}&dates=${start}/${end}&details=${details}&location=${location}`,'_blank');
});

document.querySelectorAll('.copy-btn').forEach(btn => {
  btn.addEventListener('click', async () => {
    const text = btn.getAttribute('data-copy') || '';
    try {
      await navigator.clipboard.writeText(text);
      const old = btn.textContent;
      btn.textContent = 'TERSALIN';
      setTimeout(() => btn.textContent = old, 1500);
    } catch (e) {
      alert('Nomor rekening: ' + text);
    }
  });
});
