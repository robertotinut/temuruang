# Dokumentasi Server & VPS TemuRuang

Dokumen ini berisi informasi penting mengenai kredensial server, struktur direktori, dan panduan dasar untuk mengelola VPS proyek TemuRuang.

## 1. Kredensial Server VPS

Pastikan informasi ini disimpan dengan aman dan **TIDAK** dipublikasikan ke publik.

- **Sistem Operasi**: Ubuntu
- **IP Publik (Akses Web & SSH)**: `43.133.154.13`
- **IP Privat**: `10.11.12.235`
- **Username SSH**: `ubuntu`
- **Password SSH**: `shadow-64$-storm`

---

## 2. Cara Mengakses Server (SSH)

Untuk mengelola server, Anda harus masuk melalui terminal komputer Anda (PowerShell / Command Prompt / Terminal).

**Perintah:**
```bash
ssh ubuntu@43.133.154.13
```
*Ketika diminta password, ketikkan atau paste `shadow-64$-storm` (karakter password memang tidak akan terlihat saat diketik di layar).*

Untuk keluar dari server, cukup ketik:
```bash
exit
```

---

## 3. Struktur Direktori Proyek

Semua *file* aplikasi TemuRuang disimpan di lokasi standar keamanan *web server* Linux.

- **Lokasi Source Code Utama**: 
  `/var/www/temuruang/`
  *(Berisi file controller, view, .env, rute, dll)*

- **Lokasi Direktori Publik (Terekspos Internet)**: 
  `/var/www/temuruang/public/`
  *(File index.php, gambar, css, js ada di sini)*

- **Lokasi Konfigurasi Nginx (Virtual Host)**: 
  `/etc/nginx/sites-available/temuruang`
  *(Digunakan untuk mengatur routing domain)*

- **Log Error Nginx (Untuk Debugging Jika Web Error)**:
  `/var/log/nginx/error.log`

---

## 4. Kredensial Database (MySQL)

Database sudah di-setup agar hanya bisa diakses dari dalam VPS itu sendiri (Localhost).

- **Nama Database**: `db_temuruang`
- **Username DB**: `admin`
- **Password DB**: `password123`

Untuk masuk ke panel MySQL dari dalam VPS:
```bash
mysql -u admin -p
```
*(Lalu masukkan `password123`)*

---

## 5. Panduan Dasar Mengelola Laravel di VPS

Berikut adalah beberapa perintah umum yang mungkin sering Anda butuhkan saat masuk ke dalam VPS:

**Membuka folder proyek:**
```bash
cd /var/www/temuruang
```

**Melihat atau mengedit konfigurasi .env:**
```bash
nano .env
```
*(Tekan `Ctrl+O` lalu `Enter` untuk menyimpan, dan `Ctrl+X` untuk keluar dari nano).*

**Menghapus Cache Laravel (Penting jika ada error tampilan):**
```bash
php artisan optimize:clear
```

**Me-restart Nginx (Penting setelah mengubah konfigurasi Nginx/Domain):**
```bash
sudo systemctl restart nginx
```

---

## 6. Mengganti Nama Domain (Nantinya)

Jika proses registrasi domain (misal: `temuruang.com`) sudah selesai:
1. Masuk ke pengaturan DNS Domain Anda, arahkan **A Record** ke IP `43.133.154.13`.
2. Masuk ke VPS (SSH), lalu edit file Nginx:
   ```bash
   sudo nano /etc/nginx/sites-available/temuruang
   ```
3. Cari baris `server_name 43.133.154.13;` lalu ubah menjadi `server_name temuruang.com www.temuruang.com;`.
4. Simpan, lalu *restart* Nginx: `sudo systemctl restart nginx`.
5. Ubah juga `APP_URL` di dalam file `.env` Laravel Anda.
