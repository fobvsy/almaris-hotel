# 🏨 Project Requirements Document (PRD)
# Almaris Hotel Reservation Website

---

# 1. Project Overview

## Project Name
Almaris Hotel Reservation Website

## Project Type
Web Application

## Description
Almaris Hotel Reservation Website adalah aplikasi berbasis web yang digunakan untuk melakukan reservasi kamar hotel secara online. Sistem ini menyediakan fitur booking kamar, manajemen data kamar, dan dashboard admin untuk mengelola reservasi hotel.

Project dikembangkan menggunakan:
- HTML
- CSS
- JavaScript
- Bootstrap
- PHP
- MySQL
- XAMPP

---

# 2. Project Goals

## Main Goals
- Mempermudah proses reservasi hotel secara online
- Membantu admin mengelola data hotel
- Menyediakan sistem booking yang modern dan responsive
- Memberikan pengalaman pengguna yang sederhana dan nyaman

---

# 3. Target Users

## User/Pelanggan
Pengguna yang ingin:
- melihat informasi hotel
- melihat daftar kamar
- melakukan reservasi kamar
- mengelola reservasi melalui dashboard
- melihat riwayat reservasi

## Admin
Pengguna yang mengelola:
- data kamar
- reservasi
- data user
- laporan hotel

---

# 4. Tech Stack

| Technology | Usage |
|---|---|
| HTML | Struktur halaman |
| CSS | Styling |
| Bootstrap | Responsive UI |
| JavaScript | Interaksi website |
| PHP | Backend |
| MySQL | Database |
| XAMPP | Local server |

---

# 5. Functional Requirements

## 5.1 Authentication

### Register
User dapat:
- membuat akun baru
- memasukkan nama, email, dan password

### Login
User dan admin dapat:
- login menggunakan email dan password

### Session Management

Setelah login berhasil:

#### User
- sistem membuat session user
- user diarahkan kembali ke halaman Home
- navbar berubah menjadi:
  - Home
  - Rooms
  - About
  - Contact
  - Dashboard
  - Logout

#### Admin
- sistem membuat session admin
- admin diarahkan langsung ke dashboard admin

### Logout
User dapat keluar dari sistem dan session akan dihapus.

---

## 5.2 User Features

### Home Page
Menampilkan:
- hero section
- informasi hotel
- featured rooms
- fasilitas hotel

### Dynamic Navigation

#### Guest Navigation
- Home
- Rooms
- About
- Contact
- Login

#### Authenticated User Navigation
- Home
- Rooms
- About
- Contact
- Dashboard
- Logout

### User Dashboard

Setelah login, pengguna dapat mengakses Dashboard melalui navbar.

Dashboard menampilkan:
- informasi profil pengguna
- total reservasi
- reservasi aktif
- akses ke riwayat booking
- akses cepat ke daftar kamar

### Rooms
Menampilkan:
- daftar kamar
- harga kamar
- foto kamar
- status ketersediaan

### Room Detail
Menampilkan:
- detail kamar
- fasilitas kamar
- foto kamar

### Booking
User dapat:
- memilih kamar
- memilih tanggal check-in
- memilih tanggal check-out
- melakukan reservasi

### Booking History
User dapat melihat:
- riwayat reservasi
- status reservasi
- detail booking

### Contact
Menampilkan:
- alamat hotel
- email
- nomor telepon

---

## 5.3 Admin Features

### Dashboard
Menampilkan:
- total kamar
- total user
- total reservasi

### Manage Rooms
Admin dapat:
- tambah kamar
- edit kamar
- hapus kamar
- upload foto kamar

### Manage Reservations
Admin dapat:
- melihat data reservasi
- mengubah status reservasi

### Manage Users
Admin dapat:
- melihat data user
- menghapus user
- mengubah password user

### Reports
Admin dapat:
- melihat laporan reservasi
- cetak reservasi by pdf

---

# 6. Non Functional Requirements

## Performance
- Website harus responsive
- Loading halaman cepat

## Security
- Password menggunakan hash
- Session login
- Validasi form input

## Usability
- UI mudah digunakan
- Navigation sederhana

## Compatibility
- Compatible dengan:
  - Google Chrome
  - Microsoft Edge
  - Mozilla Firefox

---

# 7. UI/UX Requirements

## Design Style
Modern Luxury

## Color Palette

| Element | Color |
|---|---|
| Primary | Navy (#0F172A) |
| Accent | Gold (#D4AF37) |
| Background | White (#FFFFFF) |
| Secondary | Light Gray (#F3F4F6) |

## Typography
- Poppins
- Montserrat

## Layout
- Responsive design
- Bootstrap Grid System
- Modern card design
- Rounded button & card

---

# 8. Database Requirements

## Database Name

```sql
almaris_hotel_db
```

## Tables
- users
- kamar
- reservasi

---

# 9. Database Structure

## users

| Field | Type |
|---|---|
| id_user | INT |
| nama | VARCHAR |
| email | VARCHAR |
| password | VARCHAR |
| role | ENUM(admin,user) |
| created_at | TIMESTAMP |

---

## kamar

| Field | Type |
|---|---|
| id_kamar | INT |
| nomor_kamar | VARCHAR |
| tipe_kamar | VARCHAR |
| harga | INT |
| status | ENUM(tersedia,dipesan) |
| foto | VARCHAR |
| created_at | TIMESTAMP |

---

## reservasi

| Field | Type |
|---|---|
| id_reservasi | INT |
| id_user | INT |
| id_kamar | INT |
| check_in | DATE |
| check_out | DATE |
| total_harga | INT |
| status | ENUM(pending,checkin,checkout) |
| created_at | TIMESTAMP |

---

# 10. Project Structure

```plaintext
almaris-hotel/
│
├── admin/
│   ├── dashboard.php
│   ├── kamar.php
│   ├── reservasi.php
│   ├── user.php
│   └── laporan.php
│
├── user/
│   ├── dashboard.php
│   └── riwayat.php
│
├── assets/
│   ├── css/
│   │   └── styles.css
│   ├── js/
│   │   ├── script.js
│   │   └── booking.js
│   └── images/
│
├── config/
│   └── koneksi.php
│
├── database.sql
│
├── index.php
├── login.php
├── register.php
├── kamar.php
├── detail_kamar.php
├── booking.php
├── kontak.php
│
├── README.md
└── PRD.md
```

---

# 11. Workflow Development

```plaintext
1. Setup Project
2. Create Database
3. Create PHP Connection
4. Create Landing Page
5. Create Register System
6. Create Login & Session System
7. Create Dynamic Navbar
8. Create User Dashboard
9. Create Admin CRUD Rooms
10. Create Room Display
11. Create Booking System
12. Create Booking History
13. Create Admin Reservation Management
14. Create Reports
15. Testing
```

---

# 12. User Authentication Flow

Guest User
↓
Home
↓
Login
↓
Validasi Email & Password
↓
Login Berhasil
↓
Redirect ke Home
↓
Navbar Berubah
(Home | Rooms | About | Contact | Dashboard | Logout)
↓
User Mengakses Dashboard
↓
Dashboard User

---

Admin Login
↓
Validasi Email & Password
↓
Login Berhasil
↓
Redirect ke Admin Dashboard

---

# 13. User Flow

Home
↓
View Rooms
↓
Login / Register
↓
Home (Navbar berubah)
↓
Dashboard
├── Informasi Profil
├── Reservasi Aktif
├── Riwayat Booking
└── Akses Cepat ke Daftar Kamar

---

Booking Flow

Home
↓
Rooms
↓
Room Detail
↓
Booking
↓
Reservation Saved
↓
Dashboard
↓
Booking History

---

# 14. Testing Plan

## Authentication Testing
- Register berhasil
- Login berhasil
- Logout berhasil

## Room Testing
- Tambah kamar berhasil
- Edit kamar berhasil
- Hapus kamar berhasil

## Booking Testing
- Booking tersimpan di database
- Riwayat booking tampil

## UI Testing
- Responsive mobile
- Responsive desktop

## Dashboard Testing
- Dashboard user tampil sesuai session
- Dashboard admin hanya dapat diakses admin
- Navbar berubah setelah login

---

# 15. Conclusion

Almaris Hotel Reservation Website merupakan sistem reservasi hotel berbasis web yang dirancang dengan konsep modern luxury untuk memberikan pengalaman pengguna yang elegan, responsive, dan mudah digunakan.