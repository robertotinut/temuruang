# Undangan Vintage Web — 1 Page

Isi project:

- `index.html`
- `css/style.css`
- `js/main.js`
- `assets/` berisi asset PNG terpisah:
  - `envelope-vintage.png`
  - `photo-frame-oval.png`
  - `flowers-left.png`
  - `flowers-right.png`
  - `hydrangea.png`
  - `butterfly.png`
  - `couple-placeholder.svg`

Cara pakai:

1. Extract ZIP.
2. Buka `index.html` di browser.
3. Klik tombol play besar di tengah untuk menjalankan animasi.

Catatan:

- Animasi utama pakai GSAP CDN. Kalau internet mati, masih ada fallback animasi CSS sederhana.
- Untuk foto pasangan, ganti `assets/couple-placeholder.svg` dengan foto kamu sendiri, lalu ubah path di `index.html` bagian `.photo-oval img`.
- Untuk musik, taruh file `music.mp3` di folder `assets/`. Tombol Play Music akan memutar file itu kalau ada.
