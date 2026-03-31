<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama }} | IESHOPP</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#F8FAF5] text-gray-900 font-sans scroll-smooth overflow-x-hidden">

<x-navbar />

<section class="max-w-[1400px] mx-auto px-6 md:px-16 pt-32 md:pt-40 pb-16 md:pb-24 flex flex-col lg:flex-row gap-8 lg:gap-20">

    <div class="w-full lg:w-1/2">
        <div class="bg-gray-100 rounded-[1.5rem] md:rounded-[2rem] p-4 flex items-center justify-center overflow-hidden group w-full aspect-square">
            @if($product->foto)
                <img src="{{ asset('storage/' . $product->foto) }}" id="mainImage" alt="{{ $product->nama }}"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            @else
                <div class="text-gray-400 font-medium">Belum ada foto</div>
            @endif
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center">

        <div class="mb-3 md:mb-4">
            <span class="inline-block py-1 px-3 rounded-full bg-[#e6edcc] text-[#3f4f30] text-[10px] md:text-xs font-bold tracking-widest uppercase">
                {{ $product->category->nama }}
            </span>
        </div>

        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-2 md:mb-4 leading-tight">
            {{ $product->nama }}
        </h1>

        <p class="text-2xl md:text-3xl font-extrabold text-[#2c3821] mb-4 md:mb-6">
            Rp {{ number_format($product->harga, 0, ',', '.') }}
        </p>

        <p class="text-gray-600 text-base md:text-lg leading-relaxed mb-6 md:mb-8">
            {{ $product->detail }}
        </p>

        <div class="w-full h-px bg-gray-200 mb-6 md:mb-8"></div>

        @if(!empty($product->warna))
        <div class="mb-6 md:mb-8">
            <h3 class="text-xs md:text-sm font-bold text-gray-400 tracking-widest uppercase mb-3">Pilih Variasi Warna</h3>
            <div class="flex flex-wrap gap-2 md:gap-3 mt-2 md:mt-3">
                @php
                    $warnaList = explode(',', $product->warna);
                @endphp
                
                @foreach($warnaList as $w)
                    @if(trim($w) != '')
                    <button class="color-btn px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl border-2 border-gray-200 text-sm md:text-base text-gray-600 font-bold hover:border-[#2c3821] hover:text-[#2c3821] focus:ring-2 focus:ring-[#C5D89D] transition-all" data-value="{{ trim($w) }}">
                        {{ trim($w) }}
                    </button>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <div class="mb-8 md:mb-10">
            <h3 class="text-xs md:text-sm font-bold text-gray-400 tracking-widest uppercase mb-3">Pilih Ukuran</h3>
            <div class="flex flex-wrap gap-2 md:gap-3 mt-2 md:mt-3">
                @php
                    $ukuranList = explode(',', $product->ukuran);
                @endphp
                @foreach($ukuranList as $u)
                    @if(trim($u) != '')
                    <button class="size-btn px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl border-2 border-gray-200 text-sm md:text-base text-gray-600 font-bold hover:border-[#2c3821] hover:text-[#2c3821] focus:ring-2 focus:ring-[#C5D89D] transition-all" data-value="{{ trim($u) }}">
                        {{ trim($u) }}
                    </button>
                    @endif
                @endforeach
            </div>
        </div>

        <input type="hidden" id="selectedVariasi" value="">
        <input type="hidden" id="selectedSize" value="">

        @if($product->ketersediaan_stok == 'habis')
            <button disabled class="w-full bg-red-500 text-white font-bold text-base md:text-lg py-3.5 md:py-4 rounded-xl shadow-lg flex justify-center items-center gap-2 md:gap-3 cursor-not-allowed opacity-70">
                Stok Habis
            </button>
        @else
            <button id="addToCartBtn" class="w-full bg-[#2c3821] text-white font-bold text-base md:text-lg py-3.5 md:py-4 rounded-xl hover:bg-[#1a2214] hover:shadow-xl transition-all duration-300 flex justify-center items-center gap-2 md:gap-3 group">
                <svg class="w-5 h-5 md:w-6 md:h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path></svg>
                Masukkan Keranjang
            </button>
        @endif

    </div>

    <div id="toast-success" class="fixed top-24 md:top-28 right-4 md:right-10 z-50 flex items-center w-full max-w-[280px] md:max-w-xs p-3 md:p-4 space-x-3 text-gray-600 bg-white rounded-xl md:rounded-2xl shadow-2xl border border-gray-100 transform transition-all duration-500 translate-x-[150%] opacity-0" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 md:w-10 md:h-10 text-green-500 bg-green-100 rounded-lg md:rounded-xl">
            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="ms-2 md:ms-3">
            <span class="mb-0.5 text-xs md:text-sm font-bold text-gray-900 block">Berhasil!</span>
            <span class="text-[10px] md:text-xs font-medium">Produk masuk keranjang.</span>
        </div>
    </div>
</section>

<script>
    // Memastikan seluruh halaman sudah selesai loading sebelum menyalakan tombol
    document.addEventListener("DOMContentLoaded", function() {
        
        const addToCartBtn = document.getElementById("addToCartBtn");
        
        // Pengecekan jika ID tombol tidak ditemukan
        if (!addToCartBtn) {
            console.error("Tombol Add to Cart tidak ditemukan!");
            return;
        }

        const colorBtns = document.querySelectorAll(".color-btn");
        colorBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                colorBtns.forEach(b => {
                    b.classList.remove("bg-[#2c3821]", "text-white", "border-[#2c3821]");
                    b.classList.add("text-gray-600", "border-gray-200");
                });

                this.classList.remove("text-gray-600", "border-gray-200");
                this.classList.add("bg-[#2c3821]", "text-white", "border-[#2c3821]");

                document.getElementById("selectedVariasi").value = this.dataset.value;
            });
        });

        const sizeBtns = document.querySelectorAll(".size-btn");
        sizeBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                sizeBtns.forEach(b => {
                    b.classList.remove("bg-[#2c3821]", "text-white", "border-[#2c3821]");
                    b.classList.add("text-gray-600", "border-gray-200");
                });

                this.classList.remove("text-gray-600", "border-gray-200");
                this.classList.add("bg-[#2c3821]", "text-white", "border-[#2c3821]");

                document.getElementById("selectedSize").value = this.dataset.value;
            });
        });

        addToCartBtn.addEventListener("click", function(e) {
            e.preventDefault(); // Menahan agar halaman tidak ter-refresh saat diklik

            try {
                // 1. AMBIL DATA DARI HALAMAN DENGAN AMAN
                const namaProduk = document.querySelector("h1") ? document.querySelector("h1").innerText : "Produk IESHOPP";
                
                const hargaElement = document.querySelector(".text-3xl.font-black");
                const hargaText = hargaElement ? hargaElement.innerText : "0";
                const hargaProduk = parseInt(hargaText.replace(/[^0-9]/g, '')) || 0;
                
                const imgElement = document.getElementById("mainImage");
                const gambar = imgElement ? imgElement.getAttribute("src") : "";

                // 2. DETEKSI OTOMATIS PILIHAN WARNA & UKURAN
                // Sistem akan mencoba mencari dari elemen tersembunyi (Hidden Input)
                let variasiInput = document.getElementById("selectedVariasi");
                let sizeInput = document.getElementById("selectedSize");
                
                let variasi = variasiInput ? variasiInput.value : null;
                let size = sizeInput ? sizeInput.value : null;

                // Jika tidak ketemu, sistem akan mencoba mencari dari Radio Button yang sedang diklik
                if (!variasi) {
                    let checkedColor = document.querySelector('input[name="color"]:checked') || document.querySelector('input[name="variasi"]:checked');
                    variasi = checkedColor ? checkedColor.value : null;
                }
                if (!size) {
                    let checkedSize = document.querySelector('input[name="size"]:checked');
                    size = checkedSize ? checkedSize.value : null;
                }

                // 3. VALIDASI (Peringatan jika belum milih)
                if (!variasi || variasi === "") {
                    alert("Ups! Jangan lupa pilih warna dulu ya.");
                    return;
                }
                if (!size || size === "") {
                    alert("Ups! Jangan lupa pilih ukuran dulu ya.");
                    return;
                }

                let hargaBersih = parseInt("{{ $product->harga }}".replace(/[^0-9]/g, '')) || 0;

                const productData = {
                    id: "{{ $product->id }}",
                    name: "{!! addslashes($product->nama) !!}", 
                    price: hargaBersih, // Memasukkan harga yang sudah dijamin murni angka
                    image: "{{ asset('storage/' . $product->foto) }}", 
                    color: variasi,
                    size: size,
                    qty: 1
                };

                // Bantuan untuk mengecek apakah harganya sudah masuk (Bisa dilihat di Inspect -> Console)
                console.log("Produk berhasil ditangkap:", productData);

                // 5. SIMPAN KE MEMORI BROWSER
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                let existingItemIndex = cart.findIndex(item => 
                    item.id === productData.id && 
                    item.color === productData.color && 
                    item.size === productData.size
                );

                if (existingItemIndex !== -1) {
                    cart[existingItemIndex].qty += 1; 
                } else {
                    cart.push(productData); 
                }

                localStorage.setItem("cart", JSON.stringify(cart));

                // 6. UPDATE ANGKA DI NAVBAR
                const badge = document.getElementById("cartBadge");
                if (badge) {
                    let totalItems = cart.reduce((total, item) => total + item.qty, 0);
                    badge.innerText = totalItems;
                    badge.classList.remove("hidden");
                }
                
                // 7. MUNCULKAN POPUP SUKSES
                const toast = document.getElementById("toast-success");
                if (toast) {
                    toast.classList.remove("translate-x-[150%]", "opacity-0");
                    toast.classList.add("translate-x-0", "opacity-100");

                    setTimeout(() => {
                        toast.classList.remove("translate-x-0", "opacity-100");
                        toast.classList.add("translate-x-[150%]", "opacity-0");
                    }, 3000);
                }

            } catch (error) {
                // Jika masih ada error, tampilkan peringatan ini alih-alih mati total
                console.error("Error Detail:", error);
                alert("Pastikan kamu sudah memilih variasi dan warna.");
            }
        });
    });
</script>

<x-footer />

</body>
</html>