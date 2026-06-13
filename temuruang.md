

# TEMURUANG V1

## Deskripsi

TemuRuang adalah platform undangan digital yang mendukung berbagai jenis acara seperti:

* Pernikahan
* Reuni
* Ulang Tahun
* Wisuda
* Seminar
* Gathering
* Acara Komunitas

Sistem menggunakan role-based access.

---

# 1. Authentication

Menggunakan Laravel Breeze.

Fitur:

* Login
* Register
* Forgot Password
* Reset Password
* Update Profile
* Change Password
* Logout

---

# 2. User Management

Role:

```text
Owner
Admin
Customer
```

Hak akses:

### Owner

Akses penuh:

* Kelola User
* Kelola Template
* Kelola Paket
* Kelola Event Type
* Kelola Semua Undangan

### Admin

Akses:

* Kelola Customer
* Kelola Undangan
* Kelola Template

Tidak bisa:

* Kelola Owner

### Customer

Akses:

* Kelola Undangan Milik Sendiri

---

Tabel:

```text
users
```

Tambahkan:

```sql
role
phone
is_active
last_login_at
```

---

# 3. Master Event Type

Tabel:

```text
event_types
```

Data awal:

```text
Pernikahan
Reuni
Ulang Tahun
Wisuda
Seminar
Gathering
Komunitas
Lainnya
```

Kolom:

```text
id
name
description
is_active
```

---

# 4. Master Template

Tabel:

```text
templates
```

Kolom:

```text
id
name
slug
thumbnail
preview_image
description
is_premium
is_active
```

Contoh:

```text
Elegant Gold
Modern Blue
Classic White
Luxury Black
```

---

# 5. Master Paket

Menurutku ini perlu dari awal.

Karena nanti pasti monetisasi.

Tabel:

```text
packages
```

Contoh:

### Free

```text
1 Template
100 Tamu
```

### Basic

```text
5 Template
500 Tamu
```

### Premium

```text
Unlimited
```

Kolom:

```text
id
name
price
max_guest
max_gallery
max_template
is_active
```

---

# 6. Customer Subscription

Tabel:

```text
subscriptions
```

Kolom:

```text
user_id
package_id
start_date
end_date
status
```

---

# 7. Invitation

Core utama sistem.

Tabel:

```text
invitations
```

Kolom:

```text
id
user_id
event_type_id
template_id

title
slug

event_date
event_time

location
address
google_maps_url

description

cover_image

status
published_at

created_at
updated_at
```

Status:

```text
draft
published
expired
```

---

# 8. Invitation Gallery

Tabel:

```text
invitation_galleries
```

Kolom:

```text
id
invitation_id
image_path
sort_order
```

---

# 9. Invitation Story

Untuk timeline.

Tabel:

```text
invitation_stories
```

Contoh:

```text
Pertama Bertemu
Tunangan
Pernikahan
```

Kolom:

```text
title
description
event_date
```

---

# 10. RSVP

Tabel:

```text
rsvps
```

Kolom:

```text
invitation_id
guest_name
phone
attendance_status
guest_count
message
```

Status:

```text
Hadir
Tidak Hadir
Masih Ragu
```

---

# 11. Guest Book

Tabel:

```text
guest_books
```

Kolom:

```text
invitation_id
guest_name
message
created_at
```

---

# 12. Dashboard

Owner/Admin:

```text
Total User
Total Customer
Total Invitation
Total RSVP
```

Customer:

```text
Total Invitation
Total Guest
Total RSVP
```

---

# 13. Landing Page

Menu:

```text
Home
Template
Pricing
FAQ
Login
Register
```

Section:

```text
Hero
Features
Template Preview
Pricing
FAQ
Footer
```

---

# V1 Scope Selesai

Setelah semua di atas selesai, baru V2:

```text
Payment Midtrans
Custom Domain
QR Check In
WhatsApp Blast
Analytics
SEO
Multi Language
```
