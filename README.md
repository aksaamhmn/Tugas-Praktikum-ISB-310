# Sistem Manajemen Dapur Takjil Ramadhan

## Overview Project

Pada pengembangan **Week 5** ini, proyek Dapur Takjil telah berevolusi dari sekadar kerangka antarmuka menjadi aplikasi dinamis yang terintegrasi penuh dengan **Database MySQL**. Fokus utama pada pembaruan ini adalah implementasi struktur _Database Relasional_, _Migrations_, _Database Seeding_, dan pemanfaatan **Eloquent ORM** bawaan Laravel untuk mengelola relasi antar tabel (One-to-Many).

---

## Fitur Sistem

Selain mempertahankan sistem Autentikasi Session dan UI _Dark Mode_ dari minggu sebelumnya, aplikasi kini memiliki kemampuan manajemen data tingkat lanjut:

1. **Integrasi Database Terpusat:** Seluruh data menu, kategori, dan donatur kini disimpan dan dipanggil secara _real-time_ dari _database_ MySQL.
2. **Relasi Data Dinamis (One-to-Many):** Setiap menu takjil memiliki keterikatan relasional secara langsung dengan satu Kategori dan satu entitas Donatur (Brand).
3. **Smart Data Insertion:** Form "Kelola Data" kini dilengkapi logika `firstOrCreate`, di mana pengguna dapat mengetikkan nama donatur baru secara bebas, dan sistem akan secara otomatis mendaftarkannya ke tabel `brands` tanpa memutus relasi data.
4. **Automated Data Seeding:** Dilengkapi dengan skrip _Seeder_ yang dapat menyuntikkan puluhan data _dummy_ awal secara instan hanya dengan satu baris perintah terminal (`migrate:fresh --seed`).

---

## Struktur Direktori Proyek (Laravel Architecture)

Pemisahan struktur kini semakin kompleks dan rapi dengan masuknya komponen Model dan entitas _Database_:

    dapur-takjil-laravel/
    │
    ├── app/
    │   ├── Http/Controllers/
    │   │   ├── AuthController.php       # Logika Autentikasi (Login/Logout)
    │   │   └── ProductController.php    # Otak pengelola CRUD menu takjil
    │   │
    │   └── Models/
    │       ├── Category.php             # Representasi tabel categories
    │       ├── Brand.php                # Representasi tabel brands (Donatur)
    │       └── Product.php              # Representasi tabel products (Menu)
    │
    ├── database/
    │   ├── migrations/                  # Cetak biru (blueprint) struktur tabel database
    │   └── seeders/
    │       └── DatabaseSeeder.php       # Skrip injeksi data dummy (13 menu takjil)
    │
    ├── resources/views/
    │   ├── layouts/
    │   │   └── main.blade.php           # Master Template
    │   ├── product.blade.php            # Tampilan Utama (Katalog Menu Dinamis)
    │   ├── kelola.blade.php             # Tampilan Form Kelola Data
    │   └── login.blade.php              # Tampilan Form Autentikasi
    │
    └── routes/
        └── web.php                      # Pengatur lalu lintas URL aplikasi

---

## Penjelasan Teknis Transformasi (Week 5)

1. **Database Migrations:**
   Pembuatan tabel tidak lagi dilakukan secara manual di phpMyAdmin. Kita menggunakan skrip PHP (_Migration_) untuk membangun skema tabel `categories`, `brands`, dan `products`, lengkap dengan penetapan _Primary Key_, _Foreign Key_, dan aturan `onDelete('cascade')` untuk menjaga integritas data.
2. **Eloquent Relationships:**
   Menghubungkan antar entitas tabel menggunakan fungsi bawaan Laravel. Tabel `Category` dan `Brand` memiliki relasi `hasMany` (memiliki banyak produk), sedangkan tabel `Product` menggunakan `belongsTo` untuk merujuk kembali ke tabel induknya.
3. **Eager Loading di Controller:**
   Pada `ProductController`, pemanggilan data produk menggunakan metode `Product::with(['category', 'brand'])->get()`. Teknik _Eager Loading_ ini mengatasi masalah performa (N+1 _query problem_) dengan menarik semua relasi sekaligus dalam satu _query_ efisien.
4. **Pembaruan View (Blade):**
   Halaman `product.blade.php` tidak lagi menggunakan data _hardcode_ HTML. Data kini di-_render_ secara dinamis menggunakan sintaks perulangan `@foreach ($products as $item)`, menampilkan properti spesifik seperti `{{ $item->product_name }}` dan data relasinya seperti `{{ $item->brand->nama_brand }}`.
