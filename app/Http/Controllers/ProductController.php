<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('product', compact('products', 'categories', 'brands'));
    }

    public function kelola()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('kelola', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'nama_brand' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $brand = Brand::firstOrCreate(['nama_brand' => $validateData['nama_brand']]);

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
            $validateData['product_image'] = $imagePath;
        }

        Product::create([
            'product_name' => $validateData['product_name'],
            'category_id' => $validateData['category_id'],
            'brand_id' => $brand->brand_id,
            'product_price' => $validateData['product_price'],
            'product_stock' => $validateData['product_stock'],
            'product_image' => $validateData['product_image']
        ]);

        return redirect('/')->with('success', 'Menu takjil berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validateData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'nama_brand' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $brand = Brand::firstOrCreate(['nama_brand' => $validateData['nama_brand']]);

        if ($request->hasFile('product_image')) {
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }
            $validateData['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        $product->update([
            'product_name' => $validateData['product_name'],
            'category_id' => $validateData['category_id'],
            'brand_id' => $brand->brand_id,
            'product_price' => $validateData['product_price'],
            'product_stock' => $validateData['product_stock'],
            'product_image' => $validateData['product_image'] ?? $product->product_image,
        ]);

        return redirect('/')->with('success', 'Menu takjil berhasil diupdate!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->delete();
        return redirect('/')->with('success', 'Menu takjil berhasil dihapus!');
    }
}
