<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    // --- FUNGSI BANTUAN 1: Mengambil & Merapikan Ukuran ---
    private function getSizesList()
    {
        $rawSizes = Product::whereNotNull('ukuran')->pluck('ukuran');
        $sizesList = [];
        foreach ($rawSizes as $sizeString) {
            $explodedSizes = array_map('trim', explode(',', $sizeString));
            $sizesList = array_merge($sizesList, $explodedSizes);
        }
        $sizes = array_unique($sizesList);

        $urutanStandar = ['S', 'M', 'L', 'XL', 'XXL', '3XL'];
        usort($sizes, function ($a, $b) use ($urutanStandar) {
            $posisiA = array_search(strtoupper($a), $urutanStandar);
            $posisiB = array_search(strtoupper($b), $urutanStandar);
            $posisiA = $posisiA === false ? 999 : $posisiA;
            $posisiB = $posisiB === false ? 999 : $posisiB;
            if ($posisiA === $posisiB) return strcmp($a, $b);
            return $posisiA <=> $posisiB;
        });

        return $sizes;
    }

    // --- FUNGSI BANTUAN 2: Logika Filter & Pencarian ---
    private function buildProductQuery(Request $request)
    {
        $query = Product::query();

        // Sembunyikan produk habis
        $query->where(function ($q) {
            $q->where('ketersediaan_stok', '!=', 'habis')
              ->orWhereNull('ketersediaan_stok');
        });

        // Filter Kategori (Sesuaikan 'category_id' jika namamu berbeda di database)
        if ($request->has('kategori') && is_array($request->kategori) && count($request->kategori) > 0) {
            $query->whereIn('categories_id', $request->kategori);
        }

        // Filter Ukuran
        if ($request->has('ukuran') && is_array($request->ukuran) && count($request->ukuran) > 0) {
            $query->where(function ($q) use ($request) {
                foreach ($request->ukuran as $ukuranDipilih) {
                    $q->orWhere('ukuran', 'like', '%' . $ukuranDipilih . '%');
                }
            });
        }

        return $query;
    }

    // Tambahkan fungsi ini di bawah fungsi index()
    public function show($id)
    {
        // Cari produk berdasarkan ID, kalau tidak ada langsung munculkan 404
        $product = Product::with('category')->findOrFail($id);
        
        // Kirim datanya ke file tampilan bernama 'detail'
        return view('product-detail', compact('product'));
    }

    // =======================================================
    // 1. HALAMAN HOMEPAGE (Dibatasi Maksimal 12 Produk)
    // =======================================================
    public function index(Request $request)
    {
        $categories = Category::all();
        $sizes = $this->getSizesList();
        
        $query = $this->buildProductQuery($request);
        
        // --- TAMBAHAN LOGIKA PENCARIAN DI HOMEPAGE ---
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where('nama', 'LIKE', '%' . $keyword . '%');
        }
        
        // Hitung total asli sebelum dipotong
        $totalProducts = $query->count(); 
        // Potong hanya ambil 12
        $products = $query->take(12)->get(); 

        return view('home', compact('categories', 'products', 'sizes', 'totalProducts'));
    }

    // =======================================================
    // 2. HALAMAN KATALOG (Menampilkan Semua Produk)
    // =======================================================
    public function katalog(Request $request)
    {
        $categories = Category::all();
        $sizes = $this->getSizesList();
        
        // Hapus baris '$query = Product::query();' yang ganda/redundan sebelumnya
        $query = $this->buildProductQuery($request);
        
        // --- LOGIKA PENCARIAN DI KATALOG ---
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where('nama', 'LIKE', '%' . $keyword . '%');
        }

        // Ambil semua tanpa dibatasi
        $products = $query->get();
        $totalProducts = $products->count();

        return view('katalog', compact('categories', 'products', 'sizes', 'totalProducts'));
    }
}