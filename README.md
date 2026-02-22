# Sistem Manajemen Dapur Takjil Ramadhan

## Overview Project

Proyek ini merupakan Tugas Akhir 1 Praktikum mata kuliah Sistem Informasi Berbasis Web. Sistem ini dibangun dan dirancang untuk memantau ketersediaan porsi, mencatat penyaluran, dan mengelola data menu takjil harian secara efisien selama bulan suci Ramadhan.

---

## 📂 Struktur Direktori Proyek

    week-1/
    │
    ├── index.html             # Halaman utama (Dashboard Statistik)
    ├── kelola.html            # Halaman form input data takjil baru
    ├── css/
    │   └── style.css          # File CSS eksternal untuk custom styling
    ├── assets/
    │   ├── favicon.jpeg       # Ikon kecil pada tab browser (format JPEG)
    │   └── pola-ramadhan.webp # Gambar pola latar belakang Hero Section
    └── README.md              # Dokumentasi lengkap proyek

---

## Penjelasan Kode Program

Proyek ini dibangun menggunakan HTML5, CSS3 kustom, dan Bootstrap 5. Berikut adalah penjelasan detail mengenai _syntax_, komponen, dan ikon.

### 1. Integrasi Framework & Library (Bagian `<head>`)

Sistem memanggil pustaka eksternal melalui CDN (Content Delivery Network) agar praktis dan tidak membebani ukuran lokal proyek.

- **Bootstrap 5 CSS:** `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/..." rel="stylesheet">`
- **Bootstrap Icons:** `<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/...">`
- **CSS Internal (Custom):** `<link rel="stylesheet" href="css/style.css">` (Sengaja diletakkan di urutan paling bawah agar spesifisitas kodenya menimpa aturan bawaan Bootstrap).
- **Favicon:** `<link rel="icon" type="image/jpeg" href="assets/favicon.jpeg">` untuk memanggil gambar ikon tab di browser.

### 2. Implementasi Bootstrap Icons

Ikon dipanggil menggunakan tag `<i>` dengan _class_ spesifik dari dokumentasi Bootstrap Icons.

- **Ikon Navbar & Menu:** `<i class="bi bi-shop me-2"></i>` (Toko), `<i class="bi bi-house-door me-1"></i>` (Beranda), dan `<i class="bi bi-clipboard-data me-1"></i>` (Kelola Data).
- **Ikon Hero Section:** `<i class="bi bi-moon-stars display-1 text-success mb-3 d-block"></i>` (Ditambah class `display-1` agar sangat besar dan `d-block` agar mengambil satu baris penuh).
- **Ikon Card Statistik:** \* `<i class="bi bi-box-seam"></i>` : Merepresentasikan **Total Porsi Tersedia**.
  - `<i class="bi bi-cup-hot"></i>` : Merepresentasikan **Menu Utama Hari Ini**.
  - `<i class="bi bi-check2-circle"></i>` : Merepresentasikan **Total Tersalurkan**.
- **Ikon Formulir:** `<i class="bi bi-file-earmark-plus me-2"></i>` (Ikon dokumen tambah pada header _card_), `<i class="bi bi-pencil-square me-2"></i>` (Tombol mulai), dan `<i class="bi bi-save me-2"></i>` (Tombol simpan).

### 3. Komponen Navbar & Layout Layouting Grid

- **Navbar Responsif:** Menggunakan `navbar-expand-lg` agar navigasi berubah menjadi tombol _hamburger_ di layar HP. Class `ms-auto` digunakan untuk mendorong seluruh tautan menu ke pojok kanan.
- **Grid System (`row g-4` & `col-md-4`):** Membagi layar menjadi 3 _Card_ sejajar di laptop (4+4+4=12 kolom). Jika diakses dari HP, otomatis bersusun ke bawah (_stacking_). Class `h-100` menjaga tinggi semua _card_ sejajar.
- **Border Utility:** Penggunaan _class_ seperti `border-success border-opacity-25` (dan `opacity-50`) memberikan sentuhan visual berupa garis bingkai hijau semi-transparan yang estetik pada _card_ dan _hero section_.
