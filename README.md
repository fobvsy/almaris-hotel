# 🏨 Almaris Hotel Reservation Website

Website Perhotelan berbasis web menggunakan HTML, CSS, JavaScript, PHP, MySQL, Bootstrap, dan XAMPP.  
Project ini dibuat untuk mempermudah proses reservasi kamar hotel secara online dengan tampilan **Modern Luxury** yang elegan, responsive, dan modern.

---

# ✨ Features

## 👤 User Features

- Register akun
- Login akun
- Melihat daftar kamar
- Melihat detail kamar
- Booking kamar hotel
- Melihat riwayat booking
- Menghubungi pihak hotel

---

## 🛠️ Admin Features

- Login admin
- Dashboard admin
- CRUD data kamar
- Mengelola reservasi
- Mengelola data user
- Melihat laporan reservasi

---

# 🎨 UI Design

Menggunakan konsep:

## Modern Luxury Style

- Navy Dark Theme
- Gold Accent
- Clean White Background
- Elegant Typography
- Responsive Layout
- Smooth Hover Animation

---

# 🧰 Tech Stack

| Technology | Function                |
| ---------- | ----------------------- |
| HTML       | Struktur website        |
| CSS        | Styling website         |
| JavaScript | Interaksi website       |
| Bootstrap  | Responsive UI Framework |
| PHP        | Backend                 |
| MySQL      | Database                |
| XAMPP      | Local Server            |

---

# 📁 Project Structure

```plaintext
hotel-app/
│
├── admin/
│   ├── dashboard.php
│   ├── kamar.php
│   ├── reservasi.php
│   ├── user.php
│   └── laporan.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── img/
│
├── config/
│   └── koneksi.php
│
├── index.php
├── about.php
├── kamar.php
├── detail_kamar.php
├── booking.php
├── login.php
├── register.php
├── riwayat.php
├── kontak.php
└── database.sql
```

---

# 🗄️ Database Structure

Database yang digunakan:

```sql
hotel_db
```

---

# 📋 Database Tables

## 1. users

Menyimpan data akun admin dan pelanggan.

| Field    | Type                 | Keterangan     |
| -------- | -------------------- | -------------- |
| id_user  | INT                  | Primary Key    |
| nama     | VARCHAR(100)         | Nama user      |
| email    | VARCHAR(100)         | Email user     |
| password | VARCHAR(255)         | Password user  |
| role     | ENUM('admin','user') | Hak akses user |

---

## 2. kamar

Menyimpan data kamar hotel.

| Field       | Type                       | Keterangan   |
| ----------- | -------------------------- | ------------ |
| id_kamar    | INT                        | Primary Key  |
| nomor_kamar | VARCHAR(20)                | Nomor kamar  |
| tipe_kamar  | VARCHAR(100)               | Jenis kamar  |
| harga       | INT                        | Harga kamar  |
| status      | ENUM('tersedia','dipesan') | Status kamar |
| foto        | VARCHAR(255)               | Foto kamar   |

---

## 3. reservasi

Menyimpan data booking pelanggan.

| Field        | Type                                 | Keterangan             |
| ------------ | ------------------------------------ | ---------------------- |
| id_reservasi | INT                                  | Primary Key            |
| id_user      | INT                                  | Foreign Key dari users |
| id_kamar     | INT                                  | Foreign Key dari kamar |
| check_in     | DATE                                 | Tanggal check in       |
| check_out    | DATE                                 | Tanggal check out      |
| total_harga  | INT                                  | Total pembayaran       |
| status       | ENUM('pending','checkin','checkout') | Status reservasi       |

---

# 🔗 Database Relationship

- Satu user dapat memiliki banyak reservasi
- Satu kamar dapat dipesan berkali-kali
- Tabel reservasi terhubung ke:
  - users
  - kamar

---

# 🧱 ERD Simple Structure

```plaintext
users
  |
  | id_user
  |
reservasi
  |
  | id_kamar
  |
kamar
```

---

# 📄 Pages

## 👤 User Pages

| Page            | Description            |
| --------------- | ---------------------- |
| Home            | Halaman utama website  |
| About           | Informasi hotel        |
| Rooms           | Daftar kamar           |
| Room Details    | Detail kamar           |
| Booking         | Form booking kamar     |
| Login           | Login user/admin       |
| Register        | Registrasi user        |
| Booking History | Riwayat booking        |
| Contact         | Informasi kontak hotel |

---

## 🛠️ Admin Pages

| Page                | Description         |
| ------------------- | ------------------- |
| Dashboard           | Statistik website   |
| Manage Rooms        | CRUD kamar          |
| Manage Reservations | Mengelola reservasi |
| Manage Users        | Mengelola user      |
| Reports             | Laporan reservasi   |

---

# 🚀 Installation

## 1. Install XAMPP

Download XAMPP:

https://www.apachefriends.org/

---

## 2. Move Project

Pindahkan folder project ke:

```plaintext
htdocs/
```

Contoh:

```plaintext
C:/xampp/htdocs/hotel-app
```

---

## 3. Start Apache & MySQL

Buka XAMPP lalu aktifkan:

- Apache
- MySQL

---

## 4. Create Database

Buka phpMyAdmin:

```plaintext
http://localhost/phpmyadmin
```

Buat database baru:

```sql
hotel_db
```

Import file:

```plaintext
database.sql
```

---

## 5. Run Project

Buka browser:

```plaintext
http://localhost/hotel-app
```

---

# 📸 Main Sections

- Navbar
- Hero Section
- Featured Rooms
- Hotel Facilities
- About Hotel
- Testimonials
- Footer

---

# 🎯 Project Goals

- Mempermudah reservasi hotel
- Membantu admin mengelola data hotel
- Memberikan pengalaman booking modern dan responsive
- Membangun sistem reservasi berbasis web menggunakan PHP dan MySQL

---

# 📚 Resources

- Bootstrap Documentation  
  https://getbootstrap.com/

- PHP Documentation  
  https://www.php.net/docs.php

- MySQL Documentation  
  https://dev.mysql.com/doc/

---

# 👨‍💻 Developer

Indratama Faturrohim & Galuh Ayu Kanita With The Team
Team: ChatGPT, Gemini, Claude
