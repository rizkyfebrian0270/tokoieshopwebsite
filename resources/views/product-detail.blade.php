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

<section class="max-w-[1400px] mx-auto px-8 md:px-16 pt-32 pb-24 flex flex-col lg:flex-row gap-12 lg:gap-20">

    <div class="w-full lg:w-1/2">
        <div class="bg-gray-100 rounded-[2rem] p-4 md:p-8 flex items-center justify-center overflow-hidden group w-full aspect-square">
            @if($product->foto)
                <img src="{{ asset('storage/' . $product->foto) }}" id="mainImage" alt="{{ $product->nama }}"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            @else
                <div class="text-gray-400 font-medium">Belum ada foto</div>
            @endif
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center">

        <div class="mb-4">
            <span class="inline-block py-1 px-3 rounded-full bg-[#e6edcc] text-[#3f4f30] text-xs font-bold tracking-widest uppercase">
                {{ $product->category->nama }}
            </span>
        </div>

        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 leading-tight">
            {{ $product->nama }}
        </h1>

        <p class="text-3xl font-extrabold text-[#2c3821] mb-6">
            Rp {{ number_format($product->harga, 0, ',', '.') }}
        </p>

        <p class="text-gray-600 text-lg leading-relaxed mb-8">
            {{ $product->detail }}
        </p>

        <div class="w-full h-px bg-gray-200 mb-8"></div>

        @if(!empty($product->warna))
        <div class="mb-8">
            <h3 class="text-sm font-bold text-gray-400 tracking-widest uppercase mb-3">Pilih Variasi Warna</h3>
            <div class="flex flex-wrap gap-3 mt-3">
                @php
                    // Memecah teks warna dari database berdasarkan koma
                    $warnaList = explode(',', $product->warna);
                @endphp
                
                @foreach($warnaList as $w)
                    @if(trim($w) != '')
                    <button class="color-btn px-4 py-2 rounded-xl border-2 border-gray-200 text-gray-600 font-bold hover:border-[#2c3821] hover:text-[#2c3821] focus:ring-2 focus:ring-[#C5D89D] transition-all" data-value="{{ trim($w) }}">
                        {{ trim($w) }}
                    </button>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <div class="mb-10">
            <h3 class="text-sm font-bold text-gray-400 tracking-widest uppercase mb-3">Pilih Ukuran</h3>
            <div class="flex flex-wrap gap-3 mt-3">
                @php
                    $ukuranList = explode(',', $product->ukuran);
                @endphp
                @foreach($ukuranList as $u)
                    @if(trim($u) != '')
                    <button class="size-btn px-4 py-2 rounded-xl border-2 border-gray-200 text-gray-600 font-bold hover:border-[#2c3821] hover:text-[#2c3821] focus:ring-2 focus:ring-[#C5D89D] transition-all" data-value="{{ trim($u) }}">
                        {{ trim($u) }}
                    </button>
                    @endif
                @endforeach
            </div>
        </div>

        <input type="hidden" id="selectedVariasi" value="">
        <input type="hidden" id="selectedSize" value="">

        @if($product->ketersediaan_stok == 'habis')
            <button disabled class="w-full bg-red-500 text-white font-bold text-lg py-4 rounded-xl shadow-lg flex justify-center items-center gap-3 cursor-not-allowed opacity-70">
                Stok Habis
            </button>
        @else
            <button class="w-full bg-[#2c3821] text-white font-bold text-lg py-4 rounded-xl hover:bg-[#1a2214] hover:shadow-xl transition-all duration-300 flex justify-center items-center gap-3 group">
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path></svg>
                Masukkan Keranjang
            </button>
        @endif

    </div>

    <div id="toast-success" class="fixed top-24 right-5 md:right-10 z-50 flex items-center w-full max-w-xs p-4 space-x-3 text-gray-600 bg-white rounded-2xl shadow-2xl border border-gray-100 transform transition-all duration-500 translate-x-[150%] opacity-0" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-green-500 bg-green-100 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="ms-3">
            <span class="mb-0.5 text-sm font-bold text-gray-900 block">Berhasil!</span>
            <span class="text-xs font-medium">Produk masuk ke keranjang.</span>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    
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

    // ADD TO CART
    const addToCartBtn = document.querySelector("button.w-full");

    addToCartBtn.addEventListener("click", function () {
        // Cek apakah tombol sedang disabled (karena stok habis)
        if(this.hasAttribute('disabled')) return;

        const namaProduk = document.querySelector("h1").innerText;
        const hargaProduk = document.querySelector("p.font-extrabold").innerText;
        const variasi = document.getElementById("selectedVariasi").value;
        const size = document.getElementById("selectedSize").value;
        
        // Memperbaiki pembacaan gambar agar sesuai ID yang baru
        const imgElement = document.getElementById("mainImage");
        const gambar = imgElement ? imgElement.getAttribute("src") : "";

        if (!variasi) {
            alert("Pilih variasi warna dulu!");
            return;
        }

        if (!size) {
            alert("Pilih ukuran dulu!");
            return;
        }

        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        const produk = {
            id: Date.now(),
            nama: namaProduk,
            harga: hargaProduk,
            variasi: variasi,
            size: size,
            gambar: gambar,
            qty: 1
        };

        cart.push(produk);
        localStorage.setItem("cart", JSON.stringify(cart));

        // ... (kodingan update badge keranjang)
        const badge = document.getElementById("cartBadge");
        if (badge) {
            badge.innerText = cart.length;
            badge.classList.remove("hidden");
        }
        
        // Panggil elemen toast
        const toast = document.getElementById("toast-success");
        
        // Tampilkan: Hapus class sembunyi, tambahkan class muncul
        toast.classList.remove("translate-x-[150%]", "opacity-0");
        toast.classList.add("translate-x-0", "opacity-100");

        // Sembunyikan otomatis setelah 3 detik
        setTimeout(() => {
            toast.classList.remove("translate-x-0", "opacity-100");
            toast.classList.add("translate-x-[150%]", "opacity-0");
        }, 3000);
    });

});
</script>

<x-footer />

</body>
</html>