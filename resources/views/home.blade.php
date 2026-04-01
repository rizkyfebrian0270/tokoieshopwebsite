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

    <section id="hero-section" class="relative min-h-[85vh] flex flex-col-reverse md:flex-row-reverse items-center justify-center px-6 md:px-16 pt-32 md:pt-24 pb-16 overflow-hidden gap-10 md:gap-16">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-[#C5D89D] rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-0 right-80 w-72 h-72 bg-[#e6edcc] rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

        <div class="w-full md:w-1/2 z-10 text-center md:text-left">
            <span class="inline-block py-1.5 px-4 rounded-full bg-[#C5D89D] text-[#3f4f30] text-xs md:text-sm font-semibold tracking-wider mb-6">
                ✨ NEW ARRIVALS 2026
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-[70px] font-black mb-6 leading-[1.2] md:leading-[1.1] tracking-tight text-[#2c3821]">
                Koleksi <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4b5d3a] to-[#7a935b]">Fashion</span> <br class="hidden md:block">
                Terbaikmu.
            </h1>

            <p class="text-gray-600 mb-8 text-base sm:text-lg md:text-xl font-light leading-relaxed max-w-lg mx-auto md:mx-0">
                Ekspresikan dirimu tanpa batas. Kualitas premium dengan potongan harga terjangkau untuk gaya hidup modern.
            </p>

            <div class="flex gap-4 justify-center md:justify-start">
                <a href="#katalog" id="btnKatalog" class="inline-flex items-center justify-center px-6 md:px-8 py-3.5 md:py-4 text-sm md:text-base font-bold text-white transition-all duration-300 bg-[#2c3821] border border-transparent rounded-full hover:bg-black hover:shadow-lg hover:-translate-y-1">
                    Mulai Belanja →
                </a>
            </div>
        </div>

        <div class="w-full md:w-1/2 z-10 relative flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('images/banner.jpg') }}"
                 class="w-4/5 md:w-full max-w-md rounded-[2rem] shadow-2xl object-cover hover:scale-[1.02] transition-transform duration-500"
                 alt="Fashion Banner">
        </div>
    </section>

    <section id="katalog" class="bg-white py-16 md:py-24">
        <div class="max-w-[1500px] mx-auto px-6 md:px-16">
            
            <div class="flex flex-col md:flex-row gap-8 md:gap-12">
                
                <div class="w-full md:w-1/4 lg:w-1/5">
                    <div class="md:sticky md:top-28">
                        
                        <button type="button" id="mobileFilterBtn" class="w-full flex md:hidden items-center justify-between bg-white border border-gray-200 shadow-sm px-5 py-3.5 rounded-2xl mb-4 text-gray-800 font-bold transition-all active:scale-95">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                Filter Produk
                            </span>
                            <svg id="filterIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div id="filterContent" class="hidden md:block transition-all duration-300 origin-top">
                            <h2 class="hidden md:block text-2xl md:text-3xl font-black tracking-tight mb-6 md:mb-8">Filter</h2>

                            <form action="{{ url('/') }}" method="GET" id="formFilter" class="bg-gray-50 md:bg-transparent p-5 md:p-0 rounded-2xl md:rounded-none border border-gray-100 md:border-none mb-8 md:mb-0 shadow-inner md:shadow-none">
                                
                            <div class="mb-8">
                                <h3 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-4">Pencarian</h3>
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." 
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-[#2c3821] focus:border-transparent transition-all text-sm shadow-sm placeholder-gray-400 text-gray-700">
                                    
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>

                                    @if(request('search'))
                                        <a href="{{ url()->current() }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-red-400 hover:text-red-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </a>
                                    @endif
                                </div>
                                <button type="submit" class="hidden">Cari</button>
                            </div>

                                <div class="mb-8 md:mb-10">
                                    <h3 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-4">Kategori</h3>
                                    <div class="flex flex-wrap gap-2 text-sm">
                                        @foreach($categories as $category)
                                        <label class="cursor-pointer">
                                            <input type="checkbox" name="kategori[]" value="{{ $category->id }}" class="peer hidden" onchange="this.form.submit()"
                                            {{ in_array($category->id, request('kategori', [])) ? 'checked' : '' }}>
                                            
                                            <div class="px-3 md:px-4 py-1.5 md:py-2 rounded-full border bg-white md:bg-transparent border-gray-200 text-gray-600 font-medium transition-all duration-200 hover:border-gray-400 peer-checked:bg-[#2c3821] peer-checked:text-white peer-checked:border-[#2c3821]">
                                                {{ $category->nama }}
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-4">Ukuran</h3>
                                    <div class="grid grid-cols-4 md:grid-cols-4 gap-2 text-sm">
                                        @foreach($sizes as $size)
                                        <label class="cursor-pointer">
                                            <input type="checkbox" name="ukuran[]" value="{{ $size }}" class="peer hidden" onchange="this.form.submit()"
                                            {{ in_array($size, request('ukuran', [])) ? 'checked' : '' }}>
                                            
                                            <div class="flex items-center justify-center py-2 rounded-lg border bg-white md:bg-transparent border-gray-200 text-gray-600 font-medium transition-all duration-200 hover:border-gray-400 peer-checked:bg-black peer-checked:text-white peer-checked:border-black">
                                                {{ $size }}
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                
                                @if(request()->has('kategori') || request()->has('ukuran'))
                                    <div class="mt-6 pt-4 border-t border-gray-200">
                                        <a href="/" class="text-sm font-bold text-red-500 hover:text-red-700 underline flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Reset Semua Filter
                                        </a>
                                    </div>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-3/4 lg:w-4/5">
                    <div class="flex flex-col md:flex-row justify-between md:items-end mb-6 md:mb-8">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-black tracking-tight">Koleksi Terpopuler</h2>
                            <p class="text-gray-500 mt-1 md:mt-2 text-sm md:text-base">Menampilkan {{ $products->count() }} produk pilihan</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">
                        @forelse($products as $product)
                        <div class="group flex flex-col bg-white rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                            
                            <div class="relative bg-gray-100 aspect-[4/5] overflow-hidden">
                                @if($product->foto)
                                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 font-medium text-xs md:text-base">No Image</div>
                                @endif
                            </div>

                            <div class="p-4 md:p-6 flex flex-col flex-grow">
                                <h4 class="text-gray-900 font-bold text-base md:text-xl mb-1 truncate" title="{{ $product->nama }}">
                                    {{ $product->nama }}
                                </h4>
                                <p class="text-[#4b5d3a] font-extrabold text-sm md:text-lg mb-3 md:mb-4">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('product.detail', $product->id) }}" class="block w-full text-center bg-gray-50 border border-gray-200 text-gray-700 font-semibold text-sm md:text-base py-2 md:py-2.5 rounded-lg md:rounded-xl group-hover:bg-[#2c3821] group-hover:text-white group-hover:border-[#2c3821] transition-all duration-300">
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
                        
                        @if($totalProducts > 12)
                        <div class="col-span-full mt-10 md:mt-14 flex justify-center">
                            <a href="{{ route('katalog') }}" class="px-6 md:px-8 py-3 rounded-xl border-2 border-[#2c3821] text-[#2c3821] text-sm md:text-base font-extrabold hover:bg-[#2c3821] hover:text-white transition-all duration-300 flex items-center gap-2 md:gap-3 group">
                                Lihat Semua Katalog
                                <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Scroll otomatis ke katalog saat klik tombol "Mulai Belanja"
            const btn = document.getElementById("btnKatalog");
            const katalog = document.getElementById("katalog");

            if(btn && katalog) {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();
                    katalog.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                });
            }

            // Script untuk Toggle Dropdown Filter di Mobile
            const filterBtn = document.getElementById('mobileFilterBtn');
            const filterContent = document.getElementById('filterContent');
            const filterIcon = document.getElementById('filterIcon');

            if(filterBtn && filterContent) {
                filterBtn.addEventListener('click', function() {
                    filterContent.classList.toggle('hidden');
                    // Putar panah ke atas jika filter sedang terbuka
                    filterIcon.classList.toggle('rotate-180');
                });
            }

            const heroSection = document.getElementById('hero-section');
            
            if (heroSection) {
                window.addEventListener('scroll', () => {
                    // Ambil posisi seberapa jauh user sudah men-scroll ke bawah
                    let scrollPos = window.scrollY;
                    
                    // Hitung transparansi (opacity)
                    // Rumus: 1 (jelas) perlahan menjadi 0 (hilang) saat mencapai jarak 400px
                    let fadeOpacity = 1 - (scrollPos / 400);
                    
                    // Pastikan angka opacity tidak tembus ke minus
                    fadeOpacity = Math.max(0, fadeOpacity);
                    
                    // Efek tambahan: Geser section sedikit ke bawah agar tercipta ilusi tertinggal (Parallax)
                    let translateY = scrollPos * 0.4;

                    // Terapkan efeknya ke hero section
                    heroSection.style.opacity = fadeOpacity;
                    heroSection.style.transform = `translateY(${translateY}px)`;
                    
                    // Sembunyikan sepenuhnya dari klik/interaksi jika sudah transparan (agar tidak menutupi tombol katalog)
                    if (fadeOpacity === 0) {
                        heroSection.style.pointerEvents = 'none';
                    } else {
                        heroSection.style.pointerEvents = 'auto';
                    }
                });
            }

            const urlParams = new URLSearchParams(window.location.search);
            
            // Jika URL memiliki parameter 'search', 'category', atau 'size'
            if (urlParams.has('search') || urlParams.has('category') || urlParams.has('size')) {
                
                // 2. Cari elemen yang memiliki id="katalog"
                const katalogSection = document.getElementById('katalog');
                
                if (katalogSection) {
                    // Beri sedikit jeda agar halaman ter-render sempurna, lalu scroll ke bawah
                    setTimeout(() => {
                        katalogSection.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'start' 
                        });
                    }, 100); // jeda 100 milidetik
                }
            }
        });
    </script>

    <x-footer />

</body>
</html>