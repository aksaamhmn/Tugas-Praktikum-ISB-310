@extends('layouts.main')

@section('title', 'Katalog Menu')

@section('content')
<section class="container mt-4">
    <div class="hero-bg p-5 text-center rounded-4 shadow-sm border border-success border-opacity-25">
        <i class="bi bi-moon-stars display-1 text-success mb-3 d-block"></i>
        <h1 class="text-body-emphasis fw-bold mb-3">Katalog Dapur Takjil</h1>
        <p class="col-lg-8 mx-auto fs-5 text-muted mb-4">
            Berikut adalah daftar menu takjil yang tersedia di database saat ini, lengkap dengan informasi kategori dan pihak donatur (brand).
        </p>
    </div>
</section>

<section class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success m-0">Statistik Dapur Hari Ini</h2>
    </div>

    <div class="row g-4" id="daftarMenu">
        @foreach ($products as $item)
        <div class="col-md-4">
            <div class="card h-100 border-success border-opacity-50 shadow-sm text-center card-takjil">
                <div class="card-body py-4">

                    <h5 class="card-title fw-bold text-secondary nama-menu mt-2">{{ $item->product_name }}</h5>

                    <div class="mb-3">
                        <span class="badge bg-success">{{ $item->category->category_name }}</span>
                        <span class="badge bg-warning text-dark"><i class="bi bi-person-heart"></i> {{ $item->brand->nama_brand }}</span>
                    </div>

                    <h3 class="fw-bold text-dark mt-3">Stok: <span class="stok-menu">{{ $item->product_stock }}</span></h3>
                    <p class="card-text text-success fw-bold fs-5">Rp {{ number_format($item->product_price, 0, ',', '.') }}</p>

                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-success btn-salurkan"><i class="bi bi-box-arrow-right"></i> Salurkan 1 Porsi</button>
                        <button class="btn btn-outline-success btn-tambah-rencana"><i class="bi bi-bookmark-plus"></i> Tambah ke Rencana</button>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection