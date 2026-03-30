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

<section class="min-h-screen max-w-7xl mx-auto px-8 md:px-16 pt-32 pb-24">

    <div class="mb-10">
        <h1 class="text-4xl font-black tracking-tight text-gray-900">Keranjang Belanja</h1>
        <p class="text-gray-500 mt-2">Periksa kembali barang belanjaanmu sebelum checkout.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-12">

        <div class="w-full lg:w-2/3 space-y-8">

            <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#4b5d3a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Alamat Pengiriman
                    </h3>
                    <p class="text-sm text-gray-500 font-light" id="alamatText">
                        Alamat belum diisi. Silakan tambahkan alamat pengiriman.
                    </p>
                </div>
                <button id="btnAlamat" class="shrink-0 text-sm font-bold text-[#2c3821] bg-[#e6edcc] px-5 py-2.5 rounded-full hover:bg-[#C5D89D] transition-colors">
                    Ubah Alamat
                </button>
            </div>

            <div class="hidden mt-2 bg-white p-6 rounded-2xl shadow-inner border border-gray-100" id="formAlamat">
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
            <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gray-100 sticky top-32">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Ringkasan</h2>

                <div class="space-y-4 text-sm font-medium text-gray-600 mb-6 pb-6 border-b border-gray-100">
                    <div class="flex justify-between">
                        <span id="subtotalText">Subtotal (0 produk)</span>
                        <span id="subtotalPrice" class="text-gray-900">Rp 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Biaya Admin</span>
                        <span class="text-gray-900">Rp 1.000</span>
                    </div>
                </div>

                <div class="flex justify-between font-black text-xl text-gray-900 mb-8">
                    <span>Total</span>
                    <span id="finalTotal">Rp 0</span>
                </div>

                <button class="w-full bg-[#2c3821] text-white py-4 rounded-full font-bold text-lg hover:bg-black transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
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

    function renderCart() {
        const container = document.getElementById("cartContainer");
        const subtotalText = document.getElementById("subtotalText");
        const subtotalPrice = document.getElementById("subtotalPrice");
        const finalTotal = document.getElementById("finalTotal");

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        
        container.innerHTML = "";

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="bg-white rounded-[2rem] p-12 text-center shadow-sm border border-gray-100">
                    <p class="text-gray-500 mb-4">Keranjang belanja kamu masih kosong.</p>
                    <a href="/" class="inline-block bg-[#C5D89D] text-[#2c3821] font-bold px-6 py-3 rounded-full hover:bg-[#e6edcc] transition">Mulai Belanja</a>
                </div>
            `;
            subtotalText.innerText = `Subtotal (0 produk)`;
            subtotalPrice.innerText = `Rp 0`;
            finalTotal.innerText = `Rp 0`;
            return;
        }

        let subtotal = 0;

        cart.forEach((item, index) => {
            const hargaNum = cleanNumber(item.harga);
            const totalItem = hargaNum * item.qty;
            subtotal += totalItem;

            // Template literal yang sudah dimodernisasi menggunakan Tailwind
            container.innerHTML += `
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row gap-6 items-center relative transition-all hover:shadow-md">
                    
                    <div class="w-full md:w-32 h-32 bg-gray-50 rounded-2xl p-2 shrink-0 flex items-center justify-center">
                        <img src="${item.gambar}" class="max-h-full object-contain mix-blend-multiply">
                    </div>

                    <div class="flex-grow w-full">
                        <h4 class="text-xl font-bold text-gray-900 mb-1">${item.nama}</h4>
                        <p class="text-sm text-gray-500 mb-4 font-medium">
                            Variasi: <span class="text-gray-800">${item.variasi}</span> | 
                            Ukuran: <span class="text-gray-800">${item.size}</span>
                        </p>

                        <div class="flex items-center justify-between w-full mt-auto">
                            
                            <select onchange="updateQty(${index}, this.value)"
                                    class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#2c3821] focus:border-[#2c3821] block px-3 py-2 cursor-pointer font-bold">
                                ${[1,2,3,4,5,6,7,8,9,10].map(q => 
                                    `<option value="${q}" ${item.qty == q ? "selected" : ""}>${q}</option>`
                                ).join("")}
                            </select>

                            <p class="font-black text-lg text-[#4b5d3a]">
                                ${formatRupiah(totalItem)}
                            </p>

                        </div>
                    </div>

                    <button onclick="deleteItem(${index})"
                            class="absolute top-6 right-6 text-gray-300 hover:text-red-500 transition-colors bg-white hover:bg-red-50 w-8 h-8 rounded-full flex items-center justify-center" title="Hapus Produk">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>
            `;
        });

        subtotalText.innerText = `Subtotal (${cart.length} produk)`;
        subtotalPrice.innerText = formatRupiah(subtotal);
        finalTotal.innerText = formatRupiah(subtotal + 1000); 
    }

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

    renderCart();
});
</script>

<x-footer />

</body>
</html>