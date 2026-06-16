# Analisis Desain: Vintage Jawa 03 (Untitled-11)

Dokumen ini berisi rangkuman lengkap mengenai elemen desain, struktur, dan aset yang ada pada template `Untitled-11.html` (Vintage Jawa 03), serta prompt AI yang bisa digunakan untuk membuat ulang atau memodifikasi desain serupa.

---

## 🎨 1. Konsep & Nuansa (Look & Feel)
- **Tema Utama:** Adat Jawa Klasik / Vintage Javanese.
- **Kesan:** Sakral, elegan, tradisional, dan megah.
- **Warna Dominan:** 
  - **Dark Brown (Coklat Tua) & Hitam:** Sebagai warna latar (background) untuk memberi kesan elegan dan misterius.
  - **Gold (Emas):** Sebagai warna aksen pada font, garis pembatas (divider), dan ornamen untuk memberi kesan mewah.
  - **Cream/Putih Tulang:** Untuk teks agar mudah dibaca di atas latar gelap.

## 🖼️ 2. Ornamen & Aset Visual
- **Kembar Mayang / Bunga Jawa:** Digunakan di sudut-sudut atau sebagai *centerpiece* di beberapa section untuk memperkuat identitas budaya Jawa (`kembar-mayang-coklat.png`, `BUNGA-JAWA-03.png`).
- **Divider Jawa:** Garis pemisah antar section tidak menggunakan garis lurus biasa, melainkan ornamen batik atau lengkungan ukiran emas (`aset-divider-tema-jawa-03.png`).
- **Audio:** Lagu latar menggunakan langgam Jawa / Campursari (Niken Salindry - Kusuma Wijaya) yang otomatis berputar saat undangan dibuka.

## 📐 3. Struktur Halaman (Sections)
1. **Cover (Buka Undangan):** Tampilan layar penuh dengan foto *prewedding*, nama mempelai, tanggal, dan nama tamu. Tombol "Buka Undangan" dengan animasi.
2. **Hero Section:** Slider/carousel foto prewedding yang berganti otomatis, menampilkan teks "The Wedding Of", nama mempelai, dan *Countdown Timer* (Hitung Mundur).
3. **Mempelai (Profile):** Pengenalan mempelai Pria dan Wanita beserta nama orang tua. Menggunakan tata letak yang estetik dengan bingkai foto artistik.
4. **Save The Date (Jadwal Acara):** Informasi Akad Nikah dan Resepsi. Menggunakan *cards* dengan detail jam, tempat, dan tombol peta arah (Google Maps). Dilengkapi dengan kutipan ayat suci.
5. **Love Story (Kisah Cinta):** Timeline vertikal yang menceritakan perjalanan cinta dari awal bertemu hingga menuju pernikahan.
6. **Gallery (Galeri Foto):** Kumpulan momen dalam bentuk *grid* atau *carousel*.
7. **Best Wishes & RSVP:** Form kehadiran tamu, drop-down pilihan (Hadir/Tidak), text area untuk ucapan, dan daftar ucapan (Guest Book) yang bisa di-scroll.
8. **Wedding Gift (Amplop Digital):** Informasi nomor rekening (Bank BNI, dll) dengan fitur "Copy to Clipboard" (Salin Alamat/Rekening).
9. **Footer:** Ucapan terima kasih dan penutup.

---

## 🤖 4. AI Prompt Template
> [!TIP]
> **Gunakan prompt di bawah ini** jika Anda ingin meminta AI (seperti saya atau sistem lain) untuk membuat ulang atau membangun template HTML/Blade dengan gaya yang sama.

**Copy Prompt Berikut:**
```text
Buatkan sebuah file HTML tunggal untuk undangan pernikahan digital (Wedding Invitation) dengan konsep "Vintage Jawa Klasik".

Berikut adalah spesifikasi desain dan fitur yang harus ada:
1. WARNA & TIPOGRAFI: 
   - Gunakan skema warna Coklat Tua, Emas (Gold), dan Krem/Putih Tulang. 
   - Latar belakang (background) harus gelap.
   - Gunakan font Serif elegan (seperti Playfair Display atau Cormorant Garamond) untuk judul/nama, dan font Sans-Serif bersih (seperti Poppins/Montserrat) untuk teks isi. Gunakan font script/latin untuk elemen dekoratif.

2. ORNAMEN:
   - Tambahkan elemen dekoratif khas Jawa (seperti svg/css pattern ukiran, kembar mayang, atau batik) di pinggiran section dan sebagai pembatas antar section (divider).

3. STRUKTUR HALAMAN (Urut dari atas):
   - COVER: Layar penuh, background foto gelap transparan, nama mempelai, tanggal, nama tamu, dan tombol "BUKA UNDANGAN" yang akan membuka akses ke bawah dan memutar musik.
   - HERO & COUNTDOWN: Judul acara, nama mempelai, dan kotak hitung mundur (hari, jam, menit, detik).
   - BISMILLAH & AYAT: Kutipan ayat suci pernikahan.
   - MEMPELAI: Foto, nama lengkap, dan nama orang tua dari pengantin Pria & Wanita.
   - ACARA: Kotak informasi Akad Nikah dan Resepsi (Tanggal, Jam, Tempat), beserta tombol petunjuk arah Maps.
   - KISAH CINTA: Timeline vertikal (Tahun & Cerita singkat).
   - GALERI FOTO: Grid foto minimalis (2 kolom).
   - RSVP & UCAPAN: Form input untuk Nama, Kehadiran (Hadir/Tidak), dan Ucapan. Di bawahnya terdapat box guestbook untuk menampilkan ucapan yang sudah masuk.
   - WEDDING GIFT: Menampilkan nama bank, nomor rekening, atas nama, dan tombol "Salin Rekening".
   - FOOTER: Penutup, ucapan terima kasih "Matur Nuwun", dan nama mempelai.

4. UX & INTERAKSI:
   - Gunakan floating bottom navigation bar (Home, Pasangan, Acara, Galeri, Ucapan).
   - Tambahkan animasi scroll (Gunakan library AOS - Animate On Scroll).
   - Tambahkan floating button untuk Play/Pause musik dan Auto-Scroll.
   - Pastikan desain sepenuhnya responsif di layar mobile (max-width: 480px) layaknya sebuah aplikasi undangan mobile.

Tuliskan seluruhnya dalam 1 file lengkap (termasuk CSS internal dan Javascript) agar siap dijalankan.
```
