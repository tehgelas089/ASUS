<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('kelola', [
            'products' => $products,
            'title' => 'Kelola Menu'
        ]);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'name.required' => 'Nama produk wajib diisi!',
                'price.required' => 'Harga wajib diisi!',
                'price.numeric' => 'Harga harus berupa angka!',
                'price.min' => 'Harga tidak boleh minus!',
                'image.image' => 'File harus berupa gambar!',
                'image.mimes' => 'Gambar hanya boleh berformat JPG, JPEG, atau PNG!',
                'image.max' => 'Ukuran gambar maksimal 2 MB!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->route('product.index')
                ->with('error', $e->validator->errors()->first());
        }

        // ➕ CEK NAMA PRODUK SUDAH ADA BELUM
        if (Product::where('name', $request->name)->exists()) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Nama Tidak boleh sama dengan yang telah ada di menu');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produk', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('product.index')->with('success', 'Menu berhasil ditambahkan!');
    }



    public function showLanding()
    {
        $products = Product::all();
        return view('landing', [
            'products' => $products,
            'title' => 'Daftar Menu'
        ]);
    }


    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'name.required' => 'Nama produk wajib diisi!',
                'price.required' => 'Harga wajib diisi!',
                'price.numeric' => 'Harga harus berupa angka!',
                'price.min' => 'Harga tidak boleh minus',
                'image.image' => 'File harus berupa gambar',
                'image.mimes' => 'Gambar hanya boleh berformat JPG, JPEG, atau PNG',
                'image.max' => 'Ukuran gambar maksimal 2 MB!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->route('product.index')
                ->with('error', $e->validator->errors()->first());
        }

        // ➕ CEK NAMA SUDAH ADA, KECUALI YANG SEDANG DIEDIT
        if (Product::where('name', $request->name)->where('id', '!=', $product->id)->exists()) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Nama Tidak boleh sama dengan yang telah ada di menu');
        }

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produk', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('product.index')->with('success', 'Menu berhasil diperbarui!');
    }



    public function destroy(Product $product)
    {
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            unlink(storage_path('app/public/' . $product->image));
        }

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Menu berhasil dihapus!');
    }
}
