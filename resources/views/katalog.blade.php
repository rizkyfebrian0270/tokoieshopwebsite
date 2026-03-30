<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IESHOPP | Koleksi Fashion 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAF5] text-gray-900 font-sans antialiased scroll-smooth">

    <x-navbar />

    <section id="katalog" class="bg-white py-24">
        <div class="max-w-[1500px] mx-auto px-8 md:px-16">
            
            <div class="flex flex-col md:flex-row gap-12">
                
                <div class="w-full md:w-1/4 lg:w-1/5">
                    <div class="sticky top-24">
                        <h2 class="text-3xl font-black tracking-tight mb-8">Filter</h2>

                        <form action="{{ url('/') }}" method="GET" id="formFilter">
                            
                            <div class="mb-10">
                                <h3 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-4">Kategori</h3>
                                <div class="flex flex-wrap gap-2 text-sm">
                                    @foreach($categories as $category)
                                    <label class="cursor-pointer">
                                        <input type="checkbox" name="kategori[]" value="{{ $category->id }}" class="peer hidden" onchange="this.form.submit()"
                                        {{ in_array($category->id, request('kategori', [])) ? 'checked' : '' }}>
                                        
                                        <div class="px-4 py-2 rounded-full border border-gray-200 text-gray-600 font-medium transition-all duration-200 hover:border-gray-400 peer-checked:bg-[#2c3821] peer-checked:text-white peer-checked:border-[#2c3821]">
                                            {{ $category->nama }}
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-4">Ukuran</h3>
                                <div class="grid grid-cols-4 gap-2 text-sm">
                                    @foreach($sizes as $size)
                                    <label class="cursor-pointer">
                                        <input type="checkbox" name="ukuran[]" value="{{ $size }}" class="peer hidden" onchange="this.form.submit()"
                                        {{ in_array($size, request('ukuran', [])) ? 'checked' : '' }}>
                                        
                                        <div class="flex items-center justify-center py-2 rounded-lg border border-gray-200 text-gray-600 font-medium transition-all duration-200 hover:border-gray-400 peer-checked:bg-black peer-checked:text-white peer-checked:border-black">
                                            {{ $size }}
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            
                            @if(request()->has('kategori') || request()->has('ukuran'))
                                <div class="mt-6">
                                    <a href="/" class="text-sm font-bold text-red-500 hover:text-red-700 underline">Reset Semua Filter</a>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>

                <div class="w-full md:w-3/4 lg:w-4/5">
                    <div class="flex justify-between items-end mb-8">
                        <div>
                            <h2 class="text-3xl font-black tracking-tight">Koleksi Ieshop</h2>
                            <p class="text-gray-500 mt-2">Semua Koleksi Produk ({{ $totalProducts }})</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                        @forelse($products as $product)
                        <div class="group flex flex-col bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                            
                            <div class="relative bg-gray-100 aspect-[4/5] overflow-hidden">
                                @if($product->foto)
                                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 font-medium">No Image</div>
                                @endif
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <h4 class="text-gray-900 font-bold text-xl mb-1 truncate" title="{{ $product->nama }}">
                                    {{ $product->nama }}
                                </h4>
                                <p class="text-[#4b5d3a] font-extrabold text-lg mb-4">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('product.detail', $product->id) }}" class="block w-full text-center bg-gray-50 border border-gray-200 text-gray-700 font-semibold py-2.5 rounded-xl group-hover:bg-[#2c3821] group-hover:text-white group-hover:border-[#2c3821] transition-all duration-300">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                        </div>
                        @empty
                        <div class="col-span-full py-16 text-center">
                            <p class="text-gray-500 text-lg font-medium">Produk tidak ditemukan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btn = document.getElementById("btnKatalog");
            const katalog = document.getElementById("katalog");

            btn.addEventListener("click", function (e) {
                e.preventDefault();
                katalog.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            });
        });
    </script>

    <x-footer />

</body>
</html>