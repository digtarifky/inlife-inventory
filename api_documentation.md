# Dokumentasi API Inlife Inventory

Semua endpoint API diakses melalui prefix `/api/v1` (jika disetting) atau `/api`.

1. **GET `/api/products`**
   - Deskripsi: Mengambil semua data master barang.
   - Respons: JSON array berisi daftar barang beserta kategori.

2. **GET `/api/borrowings`**
   - Deskripsi: Mengambil data sirkulasi peminjaman barang.
   - Respons: JSON array riwayat peminjaman.