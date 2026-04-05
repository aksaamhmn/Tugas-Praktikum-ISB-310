<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index()
    {
        // Proteksi: Tendang ke login jika belum ada sesi
        if (!session()->has('login')) {
            return redirect('/login');
        }

        // Memanggil semua data produk beserta relasi kategori dan brand-nya
        $products = Product::with(['category', 'brand'])->get();

        // Memanggil data kategori dan brand (berguna jika nanti ingin membuat fitur tambah data)
        $categories = Category::all();
        $brands = Brand::all();

        // Mengirim data ke file view 'product.blade.php'
        return view('product', compact('products', 'categories', 'brands'));
    }
    public function kelola()
    {
        if (!session()->has('login')) {
            return redirect('/login');
        }

        // Ambil data kategori dan brand untuk mengisi pilihan dropdown di form
        $categories = Category::all();
        $brands = Brand::all();

        return view('kelola', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validateData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'nama_brand' => 'required|string|max:255', // Validasi nama_brand sebagai teks
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer'
        ]);

        // 2. LOGIKA PINTAR LARAVEL: Cari brand berdasarkan nama. 
        // Jika tidak ketemu, otomatis buatkan data brand baru di tabel brands!
        $brand = Brand::firstOrCreate([
            'nama_brand' => $validateData['nama_brand']
        ]);

        // 3. Simpan ke tabel products MySQL
        Product::create([
            'product_name' => $validateData['product_name'],
            'category_id' => $validateData['category_id'],
            'brand_id' => $brand->brand_id, // Ambil ID dari brand yang ditemukan/dibuat di atas
            'product_price' => $validateData['product_price'],
            'product_stock' => $validateData['product_stock']
        ]);

        // 4. Kembalikan ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Menu takjil berhasil ditambahkan!');
    }
}
