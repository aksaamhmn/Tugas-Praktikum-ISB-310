@extends('layouts.main')

@section('title', 'Kelola Data')

@section('content')
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-success border-opacity-25">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-file-earmark-plus me-2"></i>Input Data Takjil Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ url('/kelola') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="product_name" class="form-label fw-bold text-secondary">Nama Menu</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Contoh: Es Buah, Nasi Kotak..." required />
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-bold text-secondary">Kategori</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_brand" class="form-label fw-bold text-secondary">Pihak Donatur (Brand)</label>
                            <input type="text" class="form-control" id="nama_brand" name="nama_brand" placeholder="Contoh: Hamba Allah, DKM Masjid..." required />
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="product_price" class="form-label fw-bold text-secondary">Harga (Estimasi)</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Contoh: 15000" min="0" required />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="product_stock" class="form-label fw-bold text-secondary">Jumlah Porsi (Stok)</label>
                                <input type="number" class="form-control" id="product_stock" name="product_stock" placeholder="Masukkan angka" min="1" required />
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm">
                                <i class="bi bi-save me-2"></i>Simpan Data Takjil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection