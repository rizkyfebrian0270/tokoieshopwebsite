<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    // 1. Logika untuk Halaman Dashboard
    public function dashboard()
    {
        // Menghitung total semua produk
        $totalProducts = Product::count();

        // Menghitung total semua kategori
        $totalCategories = Category::count();
        
        // Menghitung produk yang statusnya 'habis' di database
        $outOfStock = Product::where('ketersediaan_stok', 'habis')->count();

        // Sementara diset 0 atau bisa kamu hitung jika sudah menambah kolom timestamps
        $recentlyAdded = 0;

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'recentlyAdded', 'outOfStock'));
    }

    // Jangan lupa tambahkan (Request $request) di dalam kurungnya
    public function products(Request $request)
    {
        $categories = Category::all();

        // Mulai membangun query (belum mengambil data)
        $query = Product::query();

        // 1. Jika ada inputan di kolom pencarian (search)
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // 2. Jika user memilih filter kategori
        if ($request->filled('category_id')) {
            // Pastikan 'categories_id' sesuai dengan nama kolom di tabel produkmu
            $query->where('categories_id', $request->category_id);
        }

        // Ambil data maksimal 8 baris dan ingat filter pencariannya
        $products = $query->paginate(8)->withQueryString();

        return view('admin.products', compact('products', 'categories'));
    }

    // 3. Logika untuk Halaman Categories
    // Jangan lupa tambahkan (Request $request) agar bisa membaca URL
    public function categories(Request $request)
    {
        // Mulai membangun query dan hitung jumlah produk di tiap kategori
        $query = Category::withCount('products');

        // Jika ada inputan di kolom pencarian
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Ambil datanya
        $categories = $query->get();

        return view('admin.categories', compact('categories'));
    }

    // Fungsi Menyimpan Kategori Baru
    public function storeCategory(Request $request)
    {
        Category::create([
            'nama' => $request->name
        ]);

        return redirect()->back()->with('success', 'Mantap! Kategori baru berhasil ditambahkan.');
    }

    // Fungsi Menyimpan Produk Baru
    public function storeProduct(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produk', 'public');
        }

        // Jika ukuran tidak dipilih, otomatis isi dengan tanda strip "-"
        $ukuranTeks = $request->sizes ? implode(', ', $request->sizes) : '-';

        Product::create([
            'categories_id'     => $request->category_id,
            'nama'              => $request->name,
            'harga'             => $request->price,
            'ukuran'            => $ukuranTeks,
            // Trik Jitu: Tambahkan ?? '-' agar jika form kosong, database tetap aman
            'warna'             => $request->warna ?? '-',
            'detail'            => $request->keterangan ?? 'Tidak ada keterangan', 
            'foto'              => $imagePath,
            'ketersediaan_stok' => 'tersedia'
        ]);

        return redirect()->back()->with('success', 'Mantap! Produk baru berhasil ditambahkan ke katalog.');
    }

    // --- FITUR KATEGORI ---
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['nama' => $request->name]);
        return redirect()->back()->with('success', 'Mantap! Kategori berhasil diperbarui.');
    }

    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data kategori berhasil dihapus secara permanen.');
    }

    // --- FITUR PRODUK ---
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Jika user tidak upload foto baru, gunakan foto lama
        $imagePath = $product->foto; 
        if ($request->hasFile('image')) {
            // Hapus foto lama dari folder jika ada
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }
            $imagePath = $request->file('image')->store('produk', 'public');
        }

        $ukuranTeks = $request->sizes ? implode(', ', $request->sizes) : '-';

        $product->update([
            'kategori_id'       => $request->category_id,
            'nama'              => $request->name,
            'harga'             => $request->price,
            'ukuran'            => $ukuranTeks,
            'warna'             => $request->warna ?? '-',
            'detail'            => $request->keterangan ?? 'Tidak ada keterangan',
            'foto'              => $imagePath,
            'ketersediaan_stok' => $request->status // Untuk mengubah status Tersedia/Habis
        ]);

        return redirect()->back()->with('success', 'Mantap! Produk baru berhasil diperbarui.');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        // Hapus file foto dari folder
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Data produk berhasil dihapus secara permanen.');
    }
}