# Sistem Manajemen Dapur Takjil Ramadhan (Tugas Akhir 2)

## Overview Project

Sistem Manajemen Dapur Takjil ini merupakan pengembangan lanjutan (Tugas Akhir 2) dari proyek _website_ statis sebelumnya. Pada fase ini, sistem telah dihidupkan dengan fungsionalitas dan interaktivitas penuh menggunakan **Vanilla JavaScript (ES6)** dan **HTML5 Web Storage**, menjadikannya aplikasi _front-end_ yang dinamis tanpa memerlukan _database back-end_.

---

## Fitur Sistem

### 1. Fitur Tema / Dark Mode (Local Storage)

- **Deskripsi:** Pengguna dapat mengubah tampilan _website_ menjadi mode gelap atau terang melalui tombol di Navbar.
- **Logika JS:** Menggunakan metode `classList.toggle('dark-mode')` pada elemen `<body>`. Status tema disimpan di dalam **`localStorage`** sehingga preferensi pengguna tidak hilang meskipun _browser_ ditutup atau berpindah halaman (dari `index.html` ke `kelola.html`).
- **Integrasi CSS:** Mengadaptasi instruksi spesifik dengan memanipulasi _class_ bawaan Bootstrap (seperti mengubah `.text-dark` menjadi putih saat `.dark-mode` aktif) agar estetika desain tetap terjaga.

### 2. Fitur Pengelolaan Angka/Stok (Event & Logic)

- **Deskripsi:** Setiap _card_ menu takjil memiliki tombol "Salurkan 1 Porsi". Jika diklik, angka stok akan berkurang secara _real-time_ di layar dan memunculkan _alert_ konfirmasi. Tombol akan nonaktif (disabled) jika stok mencapai angka 0.
- **Logika JS:** Menggunakan teknik **DOM Traversal** (`closest()` dan `querySelector()`) untuk mencari elemen stok spesifik di dalam _card_ yang diklik. Data stok disimpan secara persisten di dalam **`localStorage`** (dengan _key_ `dataStokTakjil`) menggunakan format JSON Object.

### 3. Fitur Rencana Penyaluran / Keranjang (Session Storage & Modal)

- **Deskripsi:** Pengguna dapat menambahkan menu ke dalam daftar rencana. Daftar ini dapat dilihat melalui _Pop-up_ (Bootstrap Modal) yang dipicu dari ikon Keranjang di Navbar. Angka (_badge_) pada Navbar akan ter-update otomatis sesuai jumlah item.
- **Logika JS:** Mematuhi instruksi secara ketat dengan menyimpan data keranjang menggunakan **`sessionStorage`** (data bersifat sementara untuk sesi _tab_ saat ini). _Rendering_ data ke dalam Modal dipicu oleh _event listener_ bawaan Bootstrap (`show.bs.modal`).

### 4. Fitur Hapus Item Spesifik & Hapus Semua

- **Deskripsi:** Di dalam Modal, pengguna dapat menghapus satu menu tertentu atau mengosongkan seluruh daftar sekaligus.
- **Logika JS:** Fitur ini diimplementasikan menggunakan metode Array bawaan JavaScript yaitu **`splice(index, 1)`** untuk membuang elemen spesifik berdasarkan urutannya, serta mengosongkan _array_ dan menjalankan `sessionStorage.removeItem()` untuk fitur "Kosongkan".

---

## Struktur Direktori Proyek

    manajemen-takjil-week-2/
    │
    ├── index.html             # Halaman utama (Katalog Menu & Modal Keranjang)
    ├── kelola.html            # Halaman form input data takjil
    ├── css/
    │   └── style.css          # Styling kustom & aturan Dark Mode manual
    ├── js/
    │   └── script.js          # Logika fungsionalitas Vanilla JS & Web Storage
    ├── assets/
    │   ├── favicon.jpeg       # Ikon kecil pada tab browser
    │   ├── logo-takjil.png    # Logo navbar
    │   └── pola-ramadhan.webp # Latar belakang Hero Section
    └── README.md              # Dokumentasi lengkap proyek
