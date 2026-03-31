<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IESHOPP | Keranjang Belanja</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#F8FAF5] text-gray-900 font-sans overflow-x-hidden">

<x-navbar />

<section class="min-h-screen max-w-7xl mx-auto px-6 md:px-16 pt-32 md:pt-40 pb-16 md:pb-24">

    <div class="mb-8 md:mb-10">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight text-gray-900">Keranjang Belanja</h1>
        <p class="text-sm md:text-base text-gray-500 mt-1 md:mt-2">Periksa kembali barang belanjaanmu sebelum checkout.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

        <div class="w-full lg:w-2/3 space-y-6 md:space-y-8">

            <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] p-6 md:p-8 shadow-lg border border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2 text-base md:text-lg">
                        <svg class="w-5 h-5 text-[#4b5d3a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Alamat Pengiriman
                    </h3>
                    <p class="text-xs md:text-sm text-gray-500 font-light" id="alamatText">
                        Alamat belum diisi. Silakan tambahkan alamat pengiriman.
                    </p>
                </div>
                <button id="btnAlamat" class="w-full sm:w-auto shrink-0 text-sm font-bold text-[#2c3821] bg-[#e6edcc] px-5 py-2.5 rounded-xl md:rounded-full hover:bg-[#C5D89D] transition-colors text-center">
                    Ubah Alamat
                </button>
            </div>

            <div class="hidden mt-2 bg-white p-5 md:p-6 rounded-2xl shadow-inner border border-gray-100" id="formAlamat">
                <textarea id="inputAlamat" rows="3" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#2c3821] focus:outline-none mb-3 bg-gray-50" placeholder="Masukkan alamat lengkapmu..."></textarea>
                <div class="flex justify-end gap-2">
                    <button id="btnBatalAlamat" class="text-sm px-4 py-2 text-gray-500 font-medium hover:text-gray-800">Batal</button>
                    <button id="btnSimpanAlamat" class="text-sm bg-black text-white px-5 py-2 rounded-full font-medium hover:bg-gray-800">Simpan</button>
                </div>
            </div>

            <div id="cartContainer" class="space-y-4">
                </div>

        </div>

        <div class="w-full lg:w-1/3">
            <div class="bg-white rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-8 shadow-xl border border-gray-100 lg:sticky lg:top-32">
                <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-gray-900">Ringkasan</h2>

                <div class="space-y-3 md:space-y-4 text-sm font-medium text-gray-600 mb-6 pb-6 border-b border-gray-100">
                    <div class="flex justify-between">
                        <span id="subtotalText">Subtotal (0 produk)</span>
                        <span id="subtotalPrice" class="text-gray-900 font-bold">Rp 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Biaya Admin</span>
                        <span class="text-gray-900 font-bold">Rp 1.000</span>
                    </div>
                </div>

                <div class="flex justify-between items-center font-black text-lg md:text-xl text-gray-900 mb-6 md:mb-8">
                    <span>Total</span>
                    <span id="finalTotal" class="text-[#4b5d3a]">Rp 0</span>
                </div>

                <button id="checkoutBtn" class="w-full bg-[#2c3821] text-white py-3.5 md:py-4 rounded-xl md:rounded-full font-bold text-base md:text-lg hover:bg-black transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                    Checkout Sekarang
                </button>
            </div>
        </div>

    </div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const btnAlamat = document.getElementById("btnAlamat");
    const formAlamat = document.getElementById("formAlamat");
    const btnBatalAlamat = document.getElementById("btnBatalAlamat");
    const btnSimpanAlamat = document.getElementById("btnSimpanAlamat");
    const inputAlamat = document.getElementById("inputAlamat");
    const alamatText = document.getElementById("alamatText");

    // Load alamat dari localStorage
    const savedAlamat = localStorage.getItem("alamatPengiriman");
    if (savedAlamat) {
        alamatText.innerText = savedAlamat;
    }

    btnAlamat.addEventListener("click", () => {
        formAlamat.classList.remove("hidden");
    });

    btnBatalAlamat.addEventListener("click", () => {
        formAlamat.classList.add("hidden");
    });

    btnSimpanAlamat.addEventListener("click", () => {
        const value = inputAlamat.value.trim();
        if (value) {
            alamatText.innerText = value;
            localStorage.setItem("alamatPengiriman", value);
            formAlamat.classList.add("hidden");
        }
    });

    function cleanNumber(str) {
        return parseInt(str.replace(/[^0-9]/g, "")) || 0;
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        }).format(number);
    }

    // ==========================================
    // 1. FUNGSI MENAMPILKAN KE LAYAR (FULL VERSI)
    // ==========================================
    function renderCart() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const container = document.getElementById("cartContainer"); 
        const subtotalText = document.getElementById("subtotalText");
        const subtotalPrice = document.getElementById("subtotalPrice");
        const finalTotal = document.getElementById("finalTotal");

        // A. JIKA KERANJANG KOSONG
        if (cart.length === 0) {
            container.innerHTML = `
                <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] p-10 md:p-12 text-center shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <p class="text-gray-500 mb-6 text-sm md:text-base">Keranjang belanja kamu masih kosong.</p>
                    <a href="/" class="inline-block bg-[#C5D89D] text-[#2c3821] font-bold px-6 py-3 rounded-xl hover:bg-[#e6edcc] transition text-sm md:text-base">Mulai Belanja</a>
                </div>
            `;
            subtotalText.innerText = `Subtotal (0 produk)`;
            subtotalPrice.innerText = `Rp 0`;
            finalTotal.innerText = `Rp 0`;
            return; 
        }

        // B. JIKA KERANJANG ADA ISINYA
        container.innerHTML = ""; 
        let subtotal = 0;

        cart.forEach((item, index) => {
            // Anti-Error: Pastikan harga dan qty berupa Angka, bukan tulisan/kosong
            let price = parseInt(String(item.price).replace(/[^0-9]/g, '')) || 0;
            let qty = parseInt(item.qty) || 1;
            let ukuran = item.size;
            let warna = item.color;

            // Gambar HTML Produknya
            container.innerHTML += `
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 md:p-6 mb-4 bg-white rounded-[1.5rem] border border-gray-100 shadow-sm gap-4">
                    
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <img src="${item.image}" alt="${item.name}" class="w-20 h-20 md:w-24 md:h-24 object-cover rounded-xl bg-gray-50">
                        <div>
                            <h3 class="font-bold text-gray-900 text-base md:text-lg">${item.name}</h3>
                            <p class="text-xs md:text-sm text-gray-500 mt-1">Ukuran: ${ukuran} | Warna: ${warna}</p>
                            <p class="font-black text-[#2c3821] mt-2">Rp ${price.toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between w-full sm:w-auto gap-4 md:gap-6">
                        
                        <div class="flex items-center border border-gray-200 rounded-lg">
                            <button onclick="updateQty(${index}, ${qty - 1})" class="px-3 py-1.5 text-gray-500 hover:bg-gray-50 rounded-l-lg transition-colors" ${qty <= 1 ? 'disabled' : ''}>-</button>
                            <span class="px-4 py-1.5 font-bold text-sm border-x border-gray-200">${qty}</span>
                            <button onclick="updateQty(${index}, ${qty + 1})" class="px-3 py-1.5 text-gray-500 hover:bg-gray-50 rounded-r-lg transition-colors">+</button>
                        </div>

                        <button onclick="deleteItem(${index})" class="text-red-400 hover:text-red-600 hover:bg-red-50 p-2.5 rounded-xl transition-colors">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>

                    </div>
                </div>
            `;
            
            subtotal += (price * qty);
        });

        // C. TULIS TOTAL HARGA KE LAYAR
        subtotalText.innerText = `Subtotal (${cart.length} produk)`;
        subtotalPrice.innerText = `Rp ${subtotal.toLocaleString('id-ID')}`;
        finalTotal.innerText = `Rp ${(subtotal + 1000).toLocaleString('id-ID')}`; 
    }

    // Assign fungsi ke window agar bisa dipanggil dari HTML inline onchange/onclick
    window.updateQty = function(index, qty) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart[index].qty = parseInt(qty);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    }

    window.deleteItem = function(index) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        
        // Update badge keranjang di navbar jika ada
        const badge = document.getElementById("cartBadge");
        if (badge) {
            badge.innerText = cart.length;
            if(cart.length === 0) {
                badge.classList.add("hidden");
            } else {
                badge.classList.remove("hidden");
            }
        }
        renderCart();
    }

    // Panggil saat halaman pertama dimuat
    renderCart();

    // Tombol Checkout ke WhatsApp
    const checkoutBtn = document.getElementById("checkoutBtn");
    if (checkoutBtn) {
        checkoutBtn.addEventListener("click", function () {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            // Cegah checkout jika keranjang kosong
            if (cart.length === 0) {
                alert("Keranjang belanjaanmu masih kosong. Yuk pilih produk dulu!");
                return;
            }

            const nomorWhatsApp = "6285117526779"; 
            let pesan = "Halo Admin IESHOPP, saya ingin memesan:\n\n";
            let subtotal = 0;

            cart.forEach((item, index) => {
                let ukuran = item.size;
                let warna = item.color;

                pesan += `*${index + 1}. Nama Produk:* ${item.name}\n`;
                pesan += `   - Ukuran: ${ukuran}\n`;
                pesan += `   - Warna: ${warna}\n`;
                pesan += `   - Jumlah: ${item.qty} pcs\n`;

                let hargaBersih = parseInt(String(item.price).replace(/[^0-9]/g, '')) || 0;
                
                pesan += `   - Harga Total: Rp ${(hargaBersih * item.qty).toLocaleString('id-ID')}\n\n`;
                subtotal += (hargaBersih * item.qty);
            });

            // Tambahkan rincian harga di bawahnya (sesuai perhitungan keranjangmu)
            const biayaPenanganan = 1000;
            const totalAkhir = subtotal + biayaPenanganan;
            
            pesan += `-------------------------\n`;
            pesan += `*Subtotal:* Rp ${subtotal.toLocaleString('id-ID')}\n`;
            pesan += `*Biaya Penanganan:* Rp ${biayaPenanganan.toLocaleString('id-ID')}\n`;
            pesan += `*TOTAL PEMBAYARAN: Rp ${totalAkhir.toLocaleString('id-ID')}*\n`;
            pesan += `-------------------------\n\n`;
            pesan += `Mohon info ketersediaan stok dan instruksi pembayarannya ya. Terima kasih!`;

            // Ubah teks menjadi format URL yang dipahami browser & WhatsApp
            const urlWhatsApp = `https://wa.me/${6285117526779}?text=${encodeURIComponent(pesan)}`;

            // Buka tab baru menuju WhatsApp
            window.open(urlWhatsApp, '_blank');
        });
    }
});
</script>

<x-footer />

</body>
</html>