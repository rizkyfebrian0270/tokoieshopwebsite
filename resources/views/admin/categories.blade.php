@extends('layouts.admin')

@section('header_title', 'Manage Categories')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    
    <form method="GET" action="{{ url()->current() }}" class="flex gap-3 w-full md:w-auto">
        
        <div class="relative w-full md:w-64">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#2c3821] text-sm">
        </div>
        
        <button type="submit" class="bg-[#2c3821] text-white px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-black transition-colors">
            Cari
        </button>
        
        @if(request('search'))
            <a href="{{ url()->current() }}" class="bg-red-50 text-red-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-red-100 transition-colors flex items-center justify-center">
                Reset
            </a>
        @endif
    </form>

    <button onclick="openModal('addCategoryModal')" class="bg-[#2c3821] hover:bg-black text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 transition-all shadow-md hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Category
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden w-full lg:w-2/3">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left text-sm font-bold text-gray-700 tracking-wider">Category Name</th>
                    <th class="p-4 text-left text-sm font-bold text-gray-700 tracking-wider">Product Count</th>
                    <th class="p-4 text-center text-sm font-bold text-gray-700 tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @foreach ($categories as $category)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-bold text-gray-900">{{ $category->nama }}</td>
                    <td class="p-4">{{ $category->products_count }} Produk</td>
                    
                    <td class="p-4 flex items-center justify-center gap-2">
                        <button onclick="document.getElementById('editCategoryModal{{ $category->id }}').classList.remove('hidden')" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Edit Kategori">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>

                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            
                            <button type="button" onclick="confirmDelete(this)" title="Hapus Data" class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>

                <div id="editCategoryModal{{ $category->id }}" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
                    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg relative flex flex-col overflow-hidden">
                        
                        <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-white">
                            <h3 class="text-xl font-black text-gray-900 flex items-center gap-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Kategori: {{ $category->nama }}
                            </h3>
                            <button type="button" onclick="document.getElementById('editCategoryModal{{ $category->id }}').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT') <div class="p-6">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Category Name</label>
                                <input type="text" name="name" value="{{ $category->nama }}" required class="w-full px-4 py-3 rounded-xl bg-white border-2 border-gray-200 focus:outline-none focus:border-[#2c3821] focus:ring-4 focus:ring-[#2c3821]/10 transition-all text-gray-800 font-medium">
                            </div>

                            <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-white">
                                <button type="button" onclick="document.getElementById('editCategoryModal{{ $category->id }}').classList.add('hidden')" class="px-6 py-2.5 rounded-xl font-bold text-gray-600 border border-gray-300 hover:bg-gray-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#2c3821] hover:bg-black transition-colors shadow-md flex items-center gap-2">
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
    </div>
</div>

<div id="addCategoryModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-gray-100 relative">
        
        <div class="flex justify-between items-center p-6 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Add New Category</h3>
            <button onclick="closeModal('addCategoryModal')" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('category.store') }}" method="POST" class="p-6 space-y-5">
        @csrf 
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Category Name</label>
            <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#2c3821]" placeholder="e.g. Jaket">
        </div>
        <div class="flex justify-end gap-3 pt-6 mt-4 border-t border-gray-100">
                <button type="button" onclick="closeModal('addCategoryModal')" class="px-6 py-2.5 rounded-xl font-bold text-gray-600 border border-gray-300 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#2c3821] hover:bg-black transition-colors shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambahkan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection