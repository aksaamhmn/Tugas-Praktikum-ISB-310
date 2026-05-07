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
        
        @if(Auth::check() && Auth::user()->role === 'admin')
        <div class="d-inline-flex gap-2">
            <a href="{{ url('/kelola') }}" class="btn btn-success btn-lg px-4 rounded-pill">
                <i class="bi bi-pencil-square me-2"></i>Mulai Kelola Data
            </a>
        </div>
        @endif
    </div>
</section>

<section class="container mt-5 mb-5">
    <h2 class="text-center mb-4 fw-bold text-success">Daftar Menu Takjil</h2>
    
    <div class="row g-4" id="daftarMenu">
        @foreach ($products as $item)
        <div class="col-md-4">
            <div class="card h-100 border-success border-opacity-50 shadow-sm text-center card-takjil">
                
                @if($item->product_image)
                    <img src="{{ asset('storage/' . $item->product_image) }}" class="card-img-top" alt="{{ $item->product_name }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                    </div>
                @endif

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

                    @if(Auth::check() && Auth::user()->role === 'admin')
                    <div class="d-flex gap-2 mt-3 pt-3 border-top">
                        <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editProdukModal{{ $item->product_id }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        
                        <form action="{{ route('products.destroy', $item->product_id) }}" method="POST" class="w-100 m-0" onsubmit="return confirm('Yakin ingin menghapus {{ $item->product_name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if(Auth::check() && Auth::user()->role === 'admin')
        <div class="modal fade text-start" id="editProdukModal{{ $item->product_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Edit {{ $item->product_name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('products.update', $item->product_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="product_name" value="{{ $item->product_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="category_id" required>
                                    @foreach ($categories as $cat)
                                    <option value="{{ $cat->category_id }}" {{ $item->category_id == $cat->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pihak Donatur</label>
                                <input type="text" class="form-control" name="nama_brand" value="{{ $item->brand->nama_brand }}" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="product_price" value="{{ $item->product_price }}" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" class="form-control" name="product_stock" value="{{ $item->product_stock }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ganti Foto (Opsional)</label>
                                <input type="file" class="form-control" name="product_image" accept="image/*">
                                <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach
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