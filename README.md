# Inlife Inventory Management System

Sistem Informasi Manajemen Inventaris dan Peminjaman Barang berbasis web, dibangun menggunakan Laravel 11 dan Tailwind CSS.

## Identitas Pengembang
- **Nama:** Digta Rifky Afada
- **Instansi:** Universitas Pembangunan Nasional (UPN) "Veteran" Jawa Timur
- **Program Studi:** Sistem Informasi

## Fitur Utama
- Kelola Master Data Barang (CRUD, Upload Gambar, Notifikasi Stok Menipis)
- Sirkulasi Peminjaman & Pengembalian Barang
- Role-based Access Control (Admin, Staff, Manager)

## Cara Instalasi
1. Clone repository ini: `git clone [LINK_GITHUB_KAMU]`
2. Masuk ke direktori proyek: `cd inlife-inventory`
3. Install dependensi PHP: `composer install`
4. Install dependensi Node.js: `npm install && npm run build`
5. Salin `.env.example` menjadi `.env`: `cp .env.example .env`
6. Generate application key: `php artisan key:generate`
7. Konfigurasi database di file `.env`.
8. Import file `inlife_inventory.sql` ke database lokal Anda, atau jalankan migrasi: `php artisan migrate --seed`
9. Sambungkan folder storage: `php artisan storage:link`

## Cara Menjalankan Project
Jalankan server development lokal dengan perintah: php artisan serve


## Akun Login Testing
Email : admin@inlife.com, staff@inlife.com, manager@inlife.com
Password : password123