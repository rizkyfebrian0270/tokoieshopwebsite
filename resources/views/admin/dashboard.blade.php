@extends('layouts.admin')

@section('header_title', 'Dashboard Overview')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Statistik Utama</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50 text-xs font-bold text-gray-400 uppercase tracking-widest">
                    <th class="px-6 py-4">Metrik</th>
                    <th class="px-6 py-4 text-center">Jumlah</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4 flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <span class="font-bold text-gray-800 text-base">Total Products</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-black text-2xl text-gray-800">{{ $totalProducts }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold border border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Aktif
                        </span>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4 flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <span class="font-bold text-gray-800 text-base">Total Categories</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-black text-2xl text-gray-800">{{ $totalCategories }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            Aktif
                        </span>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4 flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-bold text-gray-800 text-base">Out of Stock</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-black text-2xl text-gray-800">{{ $outOfStock }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($outOfStock > 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                Perlu Restock
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-50 text-gray-600 text-xs font-bold border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Aman
                            </span>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Sales Overview</h3>
        <select class="text-sm border-gray-200 rounded-xl focus:ring-[#2c3821] focus:border-[#2c3821]">
            <option>This Week</option>
            <option>This Month</option>
            <option>This Year</option>
        </select>
    </div>
    
    <div class="h-80 flex items-center justify-center border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
        <div class="text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            <p class="text-gray-400 font-medium">Chart Area</p>
        </div>
    </div>
</div>

@endsection