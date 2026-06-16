# Analisis Desain: Adat Sunda Modern / Klasik

Dokumen ini berisi rangkuman lengkap mengenai elemen desain, struktur, dan aset untuk template undangan bertema Adat Sunda, serta prompt AI global yang bisa digunakan untuk membuat ulang atau memodifikasi desain serupa.

---

## 🎨 1. Konsep & Nuansa (Look & Feel)
- **Tema Utama:** Adat Sunda Klasik & Modern (Sundanis).
- **Kesan:** Anggun, suci, bersih, romantis, dan natural (keasrian alam Parahyangan).
- **Warna Dominan:** 
  - **White (Putih Bersih) & Light Gray/Silver:** Melambangkan kesucian dan kebersihan yang identik dengan pakaian adat kebaya pengantin Sunda.
  - **Sage Green / Hijau Daun Lembut:** Memberikan nuansa alam pegunungan Jawa Barat yang asri dan tenang.
  - **Gold (Emas):** Sebagai aksen pada mahkota (Siger Sunda), garis pembatas, dan teks penting untuk memberikan sentuhan mewah.
  - **Krem / Putih Tulang:** Untuk latar belakang atau kontras teks agar terlihat lembut di mata.

## 🖼️ 2. Ornamen & Aset Visual
- **Siger Sunda (Mahkota Pengantin):** Digunakan sebagai ikon utama, logo cover, atau elemen grafis pemisah untuk menegaskan identitas adat Sunda.
- **Untaian Melati (Ronce Melati):** Ornamen grafis dedaunan hijau dengan juntaian melati putih bersih yang menghiasi sudut-sudut layout.
- **Divider Sunda:** Garis pemisah antar section menggunakan motif sulur daun sirih atau ukiran bambu tipis berwarna emas/hijau sage.
- **Audio:** Instrumen musik pengiring menggunakan Degung Sunda atau Kecapi Suling yang romantis, menenangkan, dan mendalam.

## 📐 3. Struktur Halaman (Sections)
1. **Cover (Buka Undangan):** Tampilan layar penuh dengan foto *prewedding* bernuansa outdoor/alam, nama mempelai, tanggal, dan nama tamu. Tombol "Buka Undangan" dengan hiasan mahkota Siger.
2. **Hero Section:** Slider/carousel foto prewedding dengan transisi lembut, menampilkan teks "The Wedding Of", nama mempelai, dan *Countdown Timer* (Hitung Mundur).
3. **Mempelai (Profile):** Pengenalan mempelai Pria dan Wanita beserta nama orang tua. Bingkai foto berbentuk oval/kubah masjid dengan hiasan melati.
4. **Jadwal Acara (Save The Date):** Informasi Akad Nikah dan Resepsi. Menggunakan kartu berlatar krem lembut dengan detail waktu, tempat, dan tombol integrasi Google Maps.
5. **Love Story (Kisah Cinta):** Timeline vertikal dengan ikon bunga melati, menceritakan perjalanan cinta dari awal bertemu hingga jenjang pernikahan.
6. **Gallery (Galeri Foto):** Grid foto estetik dengan perpaduan warna asri alam terbuka.
7. **RSVP & Ucapan:** Form kehadiran tamu, dropdown pilihan jumlah tamu, input doa restu, serta daftar ucapan (*Guest Book*) yang mengalir ke atas.
8. **Wedding Gift (Kado Digital):** Informasi rekening bank untuk kado digital dengan fitur salin nomor rekening instan.
9. **Footer:** Penutup, ucapan terima kasih khas Sunda "Hatur Nuhun", dan nama mempelai.

---

## 🤖 4. AI Prompt Template
> [!TIP]
> **Gunakan prompt di bawah ini** jika Anda ingin meminta AI untuk membuat ulang atau membangun template HTML/Blade dengan gaya adat Sunda.

**Copy Prompt Berikut:**
```text
Buatkan sebuah file HTML tunggal untuk undangan pernikahan digital (Wedding Invitation) dengan konsep "Adat Sunda Modern/Klasik".

Berikut adalah spesifikasi desain dan fitur yang harus ada:
1. WARNA & TIPOGRAFI: 
   - Gunakan skema warna Putih Bersih (Dominan), Hijau Sage/Muda (Aksen Alami), Krem Lembut, dan aksen Emas (Gold) pada elemen penting.
   - Gunakan font Serif elegan (seperti Playfair Display) untuk judul/nama, dan font Sans-Serif bersih (seperti Montserrat/Inter) untuk teks isi. Gunakan font script/latin tipis untuk elemen kutipan.

2. ORNAMEN:
   - Tambahkan elemen dekoratif khas Sunda (seperti siluet siger sunda, ronce melati, atau ukiran bambu tipis) di pinggiran section dan sebagai pembatas antar section (divider).

3. STRUKTUR HALAMAN (Urut dari atas):
   - COVER: Layar penuh, latar belakang foto alam asri transparan, nama mempelai, tanggal, nama tamu, dan tombol "BUKA UNDANGAN" yang akan membuka akses ke bawah dan memutar musik kecapi suling.
   - HERO & COUNTDOWN: Judul acara, nama mempelai, dan kotak hitung mundur (hari, jam, menit, detik) berlatar hijau sage transparan.
   - BISMILLAH & AYAT: Kutipan ayat suci pernikahan dengan bingkai daun sirih emas.
   - MEMPELAI: Foto dengan bingkai oval melati, nama lengkap, dan nama orang tua dari pengantin Pria & Wanita.
   - ACARA: Kotak informasi Akad Nikah dan Resepsi (Tanggal, Jam, Tempat), beserta tombol petunjuk arah Maps.
   - KISAH CINTA: Timeline vertikal dengan penanda ikon bunga melati emas.
   - GALERI FOTO: Grid foto minimalis (asimetris estetik).
   - RSVP & UCAPAN: Form input untuk Nama, Kehadiran (Hadir/Tidak), dan Ucapan. Di bawahnya terdapat box guestbook untuk menampilkan ucapan yang sudah masuk.
   - WEDDING GIFT: Menampilkan nama bank, nomor rekening, atas nama, dan tombol "Salin Rekening".
   - FOOTER: Penutup, ucapan terima kasih "Hatur Nuhun", dan nama mempelai.

4. UX & INTERAKSI:
   - Gunakan floating bottom navigation bar (Home, Pasangan, Acara, Galeri, Ucapan) yang melengkung elegan.
   - Tambahkan animasi scroll reveal yang halus.
   - Tambahkan floating button untuk Play/Pause musik kecapi suling dan Auto-Scroll.
   - Pastikan desain sepenuhnya responsif di layar mobile (max-width: 480px).

Tuliskan seluruhnya dalam 1 file lengkap (termasuk CSS internal dan Javascript) agar siap dijalankan.
```
