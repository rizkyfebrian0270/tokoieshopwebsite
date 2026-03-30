@extends('layouts.admin')

@section('header_title', 'Manage Products')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    
    <form method="GET" action="{{ url()->current() }}" class="flex gap-3 w-full md:w-auto">
    
        <div class="relative w-full md:w-64">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#2c3821] text-sm">
        </div>

        <select name="category_id" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#2c3821] text-sm bg-white cursor-pointer">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nama }}
                </option>
            @endforeach
        </select>
        
        <button type="submit" class="bg-[#2c3821] text-white px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-black transition-colors">
            Cari
        </button>
        
        @if(request('search') || request('category_id'))
            <a href="{{ url()->current() }}" class="bg-red-50 text-red-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-red-100 transition-colors flex items-center justify-center">
                Reset
            </a>
        @endif
    </form>

    <button onclick="openModal('addProductModal')" class="bg-[#2c3821] hover:bg-black text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 transition-all shadow-md hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Product
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                    <th class="p-4 font-bold">Product Name</th>
                    <th class="p-4 font-bold">Price</th>
                    <th class="p-4 font-bold">Category</th>
                    <th class="p-4 font-bold">Sizes</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
            @foreach ($products as $product)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 flex items-center gap-3">
                        <img src="{{ $product->foto ? asset('storage/'.$product->foto) : asset('images/produk.png') }}" class="w-10 h-10 rounded-lg object-cover bg-gray-100">
                        <span class="font-bold text-gray-900">{{ $product->nama }}</span>
                    </td>
                    <td class="p-4 font-semibold text-[#4b5d3a]">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </td>
                    <td class="p-4">{{ $product->category ? $product->category->nama : 'Tanpa Kategori' }}</td>
                    <td class="p-4">{{ $product->ukuran }}</td>
                    <td class="p-4">
                        @if($product->ketersediaan_stok == 'tersedia')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Tersedia</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Habis</span>
                        @endif
                    </td>
                    <td class="p-4 flex justify-center gap-2">
                        <button onclick="document.getElementById('editProductModal{{ $product->id }}').classList.remove('hidden')" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>

                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            
                            <button type="button" onclick="confirmDelete(this)" title="Hapus Data" class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>

                <div id="editProductModal{{ $product->id }}" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
                    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl relative max-h-[90vh] flex flex-col overflow-hidden">
                        
                        <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-white z-10">
                            <h3 class="text-xl font-black text-gray-900 flex items-center gap-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Produk: {{ $product->nama }}
                            </h3>
                            <button onclick="document.getElementById('editProductModal{{ $product->id }}').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="flex-grow overflow-y-auto">
                            @csrf
                            @method('PUT') <div class="p-6 space-y-6">
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Produk</label>
                                    <input type="text" name="name" value="{{ $product->nama }}" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium">
                                </div>

                                <div class="grid grid-cols-3 gap-5">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp)</label>
                                        <input type="number" name="price" value="{{ $product->harga }}" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                                        <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium cursor-pointer">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->categories_id == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Status Stok</label>
                                        <select name="status" class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium cursor-pointer">
                                            <option value="tersedia" {{ $product->ketersediaan_stok == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="habis" {{ $product->ketersediaan_stok == 'habis' ? 'selected' : '' }}>Habis</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">Ukuran Tersedia <span class="text-xs font-normal text-gray-400">(Centang ulang jika ingin mengubah)</span></label>
                                    <div class="flex flex-wrap gap-3">
                                        @php 
                                            // Ubah teks ukuran dari DB menjadi array agar bisa dicek (asumsi dipisah koma)
                                            $currentSizes = explode(', ', $product->ukuran ?? ''); 
                                        @endphp
                                        @foreach(['S', 'M', 'L', 'XL', 'XXL', 'All Size'] as $size)
                                        <label class="cursor-pointer relative">
                                            <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ in_array($size, $currentSizes) ? 'checked' : '' }} class="peer hidden">
                                            <div class="px-5 py-2.5 rounded-xl border-2 border-gray-200 text-gray-500 font-bold peer-checked:border-[#2c3821] peer-checked:bg-[#2c3821] peer-checked:text-white transition-all duration-200 select-none hover:border-gray-300 shadow-sm">
                                                {{ $size }}
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Warna</label>
                                    <input type="text" name="warna" value="{{ $product->warna }}" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan / Deskripsi Produk</label>
                                    <textarea name="keterangan" rows="4" class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium resize-none">{{ $product->detail }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto Produk <span class="text-xs font-normal text-gray-400">(Biarkan kosong jika tidak diganti)</span></label>
                                    <input type="file" name="image" class="w-full px-4 py-3 rounded-xl bg-white border-2 border-dashed border-gray-300 focus:outline-none focus:border-[#2c3821] transition-all text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#e6edcc] file:text-[#2c3821] hover:file:bg-[#C5D89D] cursor-pointer">
                                </div>

                            </div>

                            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-white sticky bottom-0 z-10">
                                <button type="button" onclick="document.getElementById('editProductModal{{ $product->id }}').classList.add('hidden')" class="px-6 py-2.5 rounded-xl font-bold text-gray-600 border-2 border-gray-200 hover:bg-gray-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#2c3821] hover:bg-black transition-colors shadow-lg shadow-[#2c3821]/30 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</div>

<div id="addProductModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl relative max-h-[90vh] flex flex-col overflow-hidden">
        
        <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-white z-10">
            <h3 class="text-xl font-black text-gray-900">Tambah Produk Baru</h3>
            <button onclick="closeModal('addProductModal')" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="flex-grow overflow-y-auto">
            @csrf
            <div class="p-6 space-y-6">
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium" placeholder="Contoh: Kaos Polos Premium">
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp)</label>
                        <input type="number" name="price" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium" placeholder="50000">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Kategori</label>
                        <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium cursor-pointer">
                            <option value="">Pilih kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">Ukuran Tersedia</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['S', 'M', 'L', 'XL', 'XXL', 'All Size'] as $size)
                        <label class="cursor-pointer relative">
                            <input type="checkbox" name="sizes[]" value="{{ $size }}" class="peer hidden">
                            <div class="px-5 py-2.5 rounded-xl border-2 border-gray-200 text-gray-500 font-bold peer-checked:border-[#2c3821] peer-checked:bg-[#2c3821] peer-checked:text-white transition-all duration-200 select-none hover:border-gray-300 shadow-sm">
                                {{ $size }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Warna</label>
                    <input type="text" name="warna" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium" placeholder="Contoh: Hitam, Putih, Navy">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan / Deskripsi Produk</label>
                    <textarea name="keterangan" rows="4" class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium resize-none" placeholder="Tuliskan detail bahan, keunggulan, atau catatan produk di sini..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Produk</label>
                    <input type="file" name="image" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-dashed border-gray-300 focus:outline-none focus:border-[#2c3821] transition-all text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#e6edcc] file:text-[#2c3821] hover:file:bg-[#C5D89D] cursor-pointer">
                </div>

            </div>

            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-white sticky bottom-0 z-10">
                <button type="button" onclick="closeModal('addProductModal')" class="px-6 py-2.5 rounded-xl font-bold text-gray-600 border-2 border-gray-200 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#2c3821] hover:bg-black transition-colors shadow-lg shadow-[#2c3821]/30 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambahkan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection