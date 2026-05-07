# Sistem Manajemen Dapur Takjil Ramadhan

## Overview Project

Pada pengembangan **Week 9** ini, proyek Dapur Takjil telah bertransformasi menjadi aplikasi manajemen yang komprehensif berstandar industri. Fokus utama pembaruan ini adalah implementasi **Advanced CRUD** dengan fitur **Upload Gambar**, penguatan sistem keamanan menggunakan **Laravel Breeze**, serta penerapan **Role Management** (Admin & User) yang dikendalikan melalui **Custom Middleware**.

---

## Fitur Utama Sistem

Aplikasi kini memiliki alur kerja dinamis dengan fitur-fitur wajib sebagai berikut:

1. **Slicing Template & Modularitas:** Menggunakan teknik pembagian layout menjadi komponen modular (_navbar_, _layouts_, _partials_) untuk efisiensi kode menggunakan Blade Templating.
2. **Advanced CRUD dengan Image Upload:** Pengelolaan data menu takjil kini mendukung pengunggahan file fisik gambar ke server, lengkap dengan validasi dan otomatisasi penghapusan file lama saat di-_update_ atau di-_delete_.
3. **Autentikasi Laravel Breeze:** Implementasi sistem login, registrasi, dan logout yang kokoh menggunakan _package_ resmi Laravel Breeze.
4. **Role Management (Admin & User):** - **Admin:** Memiliki otoritas penuh untuk mengelola data (Tambah, Lihat, Edit, Hapus).
    - **User:** Hanya memiliki akses untuk melihat katalog menu takjil tanpa izin modifikasi.
5. **Keamanan Middleware:** Seluruh rute sensitif dilindungi oleh _Middleware Auth_ dan _Custom Middleware Role_ untuk mencegah akses ilegal.
6. **Manajemen Profil & Storage:** Pengguna dapat mengelola informasi profil termasuk mengunggah foto profil yang disimpan secara aman di direktori _storage_ Laravel.

---

## Struktur Direktori Proyek (Advanced Architecture)

Struktur proyek kini mencakup komponen autentikasi dan manajemen file fisik:

    dapur-takjil-laravel/
    │
    ├── app/
    │   ├── Http/Controllers/
    │   │   ├── ProductController.php    # CRUD Produk dengan logika Upload & Role
    │   │   └── ProfileController.php    # Manajemen Profil & Foto User
    │   ├── Http/Middleware/
    │   │   └── CheckRole.php            # Satpam penyeleksi Role Admin/User
    │   └── Models/
    │       ├── Product.php              # Model Produk dengan kolom image
    │       └── User.php                 # Model User dengan kolom role & profile_image
    │
    ├── database/
    │   └── migrations/                  # Migration tabel dengan kolom image & role
    │
    ├── public/
    │   └── storage/                     # Symlink ke direktori storage asli
    │
    ├── resources/views/
    │   ├── layouts/
    │   │   └── main.blade.php           # Master Layout Utama
    │   ├── partials/
    │   │   └── navbar.blade.php         # Navbar dinamis (Auth/Guest)
    │   ├── profile/                     # View manajemen profil Breeze
    │   └── product.blade.php            # View Katalog dinamis dengan tombol aksi
    │
    ├── routes/
    │   ├── web.php                      # Routing dengan proteksi Middleware
    │   └── auth.php                     # Rute Autentikasi bawaan Breeze
    │
    └── storage/app/public/              # Direktori fisik penyimpanan gambar

---

## Penjelasan Teknis Transformasi (Week 9)

### 1. Slicing Template & Layouting

Menerapkan perintah `@yield` pada _Master Layout_ sebagai ruang dinamis dan `@extends` pada halaman anak. Komponen seperti _Navbar_ dipisahkan ke dalam folder `partials` dan dipanggil menggunakan `@include` untuk memudahkan pemeliharaan kode.

### 2. Sistem Storage & Upload Gambar

Pengiriman file menggunakan atribut `enctype="multipart/form-data"` pada form HTML. Di sisi server, sistem memisahkan penyimpanan: nama file masuk ke database, sementara file fisik disimpan di `storage/app/public/`. Perintah `php artisan storage:link` dijalankan untuk membuat _symlink_ agar gambar dapat diakses oleh publik.

### 3. Middleware & Keamanan Berbasis Role

Dibuat _Custom Middleware_ (`CheckRole`) yang didaftarkan di `bootstrap/app.php`. Middleware ini bertugas mengecek properti `role` pada tabel `users`. Jika pengguna dengan role 'user' mencoba mengakses rute CRUD Admin, sistem akan secara otomatis melakukan _redirect_ balik ke halaman utama.

### 4. Integrasi Laravel Breeze

Mengganti sistem login manual dengan Breeze untuk mendapatkan fitur autentikasi standar industri. Tampilan navbar kini adaptif menggunakan _directive_ `@auth` dan `@guest`, serta menampilkan foto profil pengguna secara dinamis dari database.
