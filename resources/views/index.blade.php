@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<section class="container mt-4">
    <div class="hero-bg p-5 text-center rounded-4 shadow-sm border border-success border-opacity-25">
        <i class="bi bi-moon-stars display-1 text-success mb-3 d-block"></i>
        <h1 class="text-body-emphasis fw-bold mb-3">Selamat Datang di Dapur Takjil</h1>
        <p class="col-lg-8 mx-auto fs-5 text-muted mb-4">
            Sistem Informasi Manajemen terpadu untuk memantau ketersediaan porsi, mencatat penyaluran, dan mengelola data menu takjil harian secara efisien selama bulan suci Ramadhan.
        </p>
        <div class="d-inline-flex gap-2">
            <a href="{{ url('/kelola') }}" class="btn btn-success btn-lg px-4 rounded-pill">
                <i class="bi bi-pencil-square me-2"></i>Mulai Kelola Data
            </a>
        </div>
    </div>
</section>

<section class="container mt-5 mb-5">
    <h2 class="text-center mb-4 fw-bold text-success">Statistik Dapur Hari Ini</h2>
    <div class="row g-4" id="daftarMenu">
        <div class="col-md-4">
            <div class="card h-100 border-success border-opacity-50 shadow-sm text-center card-takjil">
                <div class="card-body py-4">
                    <div class="display-4 text-success mb-2"><i class="bi bi-cup-hot"></i></div>
                    <h5 class="card-title fw-bold text-secondary nama-menu">Es Pisang Ijo</h5>
                    <h3 class="fw-bold text-dark mt-3">Stok: <span class="stok-menu">50</span></h3>
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-success btn-salurkan"><i class="bi bi-box-arrow-right"></i> Salurkan 1 Porsi</button>
                        <button class="btn btn-outline-success btn-tambah-rencana"><i class="bi bi-bookmark-plus"></i> Tambah ke Rencana</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-warning border-opacity-50 shadow-sm text-center card-takjil">
                <div class="card-body py-4">
                    <div class="display-4 text-warning mb-2"><i class="bi bi-box-seam"></i></div>
                    <h5 class="card-title fw-bold text-secondary nama-menu">Nasi Kotak Ayam</h5>
                    <h3 class="fw-bold text-dark mt-3">Stok: <span class="stok-menu">35</span></h3>
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-success btn-salurkan"><i class="bi bi-box-arrow-right"></i> Salurkan 1 Porsi</button>
                        <button class="btn btn-outline-success btn-tambah-rencana"><i class="bi bi-bookmark-plus"></i> Tambah ke Rencana</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-info border-opacity-50 shadow-sm text-center card-takjil">
                <div class="card-body py-4">
                    <div class="display-4 text-info mb-2"><i class="bi bi-cup-straw"></i></div>
                    <h5 class="card-title fw-bold text-secondary nama-menu">Kolak Pisang</h5>
                    <h3 class="fw-bold text-dark mt-3">Stok: <span class="stok-menu">20</span></h3>
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-success btn-salurkan"><i class="bi bi-box-arrow-right"></i> Salurkan 1 Porsi</button>
                        <button class="btn btn-outline-success btn-tambah-rencana"><i class="bi bi-bookmark-plus"></i> Tambah ke Rencana</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRencana" tabindex="-1" aria-labelledby="modalRencanaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="modalRencanaLabel"><i class="bi bi-card-checklist me-2"></i>Daftar Rencana Penyaluran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="daftarRencanaModal"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger me-auto" onclick="hapusRencana()">Kosongkan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ url('/kelola') }}" class="btn btn-success"><i class="bi bi-arrow-right-circle me-1"></i>Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection