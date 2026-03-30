<nav class="fixed top-6 left-0 right-0 z-50 px-4 flex justify-center pointer-events-none">
    <div class="bg-white/80 backdrop-blur-xl shadow-lg shadow-gray-200/50 border border-white rounded-full px-6 py-3 md:px-8 md:py-4 flex items-center justify-between w-full max-w-5xl pointer-events-auto transition-all duration-300">
        
        <a href="/" class="text-2xl font-black tracking-tighter text-[#2c3821] flex items-center gap-1 hover:scale-105 transition-transform duration-300">
            IE<span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4b5d3a] to-[#7a935b]">SHOP</span>
        </a>
        
        <ul class="hidden md:flex items-center gap-10">
            <li>
                <a href="/" class="relative text-sm font-bold text-gray-500 hover:text-[#2c3821] transition-colors group tracking-wide">
                    HOME
                    <span class="absolute -bottom-1.5 left-1/2 w-0 h-0.5 bg-[#2c3821] transition-all duration-300 group-hover:w-full group-hover:left-0 rounded-full"></span>
                </a>
            </li>
            <li>
                <a href="/tentang-kami" class="relative text-sm font-bold text-gray-500 hover:text-[#2c3821] transition-colors group tracking-wide">
                    TENTANG KAMI
                    <span class="absolute -bottom-1.5 left-1/2 w-0 h-0.5 bg-[#2c3821] transition-all duration-300 group-hover:w-full group-hover:left-0 rounded-full"></span>
                </a>
            </li>
            <li>
                <a href="/kontak" class="relative text-sm font-bold text-gray-500 hover:text-[#2c3821] transition-colors group tracking-wide">
                    KONTAK
                    <span class="absolute -bottom-1.5 left-1/2 w-0 h-0.5 bg-[#2c3821] transition-all duration-300 group-hover:w-full group-hover:left-0 rounded-full"></span>
                </a>
            </li>
        </ul>
        
        <div class="flex items-center">
            <a href="/cart" class="relative flex items-center justify-center w-11 h-11 rounded-full bg-gray-50 hover:bg-[#2c3821] hover:text-white text-[#2c3821] border border-gray-100 transition-all duration-300 group shadow-sm hover:shadow-md hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                
                <span id="cartBadge" class="absolute -top-1.5 -right-1.5 hidden bg-red-500 text-white text-[10px] rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-md border-2 border-white transform transition-transform duration-300">
                    0
                </span>
            </a>
        </div>

    </div>
    <div id="page-loader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-[#F8FAF5] transition-opacity duration-500 opacity-100">
        <div class="flex flex-col items-center gap-4">
            <div class="w-14 h-14 border-4 border-[#e6edcc] border-t-[#2c3821] rounded-full animate-spin"></div>
            <p class="text-[#2c3821] font-black tracking-widest animate-pulse text-sm">MEMUAT...</p>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function updateCartBadge() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const badge = document.getElementById("cartBadge");

            if (!badge) return;

            if (cart.length > 0) {
                badge.innerText = cart.length;
                badge.classList.remove("hidden");
            } else {
                badge.classList.add("hidden");
            }
        }

        // Panggil saat halaman pertama kali dimuat
        updateCartBadge();
        
        // Dengarkan perubahan pada localStorage (agar badge update jika keranjang diubah di tab lain)
        window.addEventListener('storage', updateCartBadge);

        const loader = document.getElementById("page-loader");
        
        setTimeout(() => {
            loader.classList.add("opacity-0");
            setTimeout(() => {
                loader.classList.add("hidden");
            }, 500); // Menunggu transisi CSS opacity selesai
        }, 300);

        const links = document.querySelectorAll("a");
        links.forEach(link => {
            link.addEventListener("click", function (e) {
                // Pastikan yang diklik adalah link halaman dalam website ini (bukan link luar, download, atau sekadar scroll ke bawah)
                if (
                    this.href && 
                    this.href.startsWith(window.location.origin) && 
                    !this.hasAttribute("target") && 
                    !this.hasAttribute("download") &&
                    !this.href.includes('#') 
                ) {
                    e.preventDefault(); // Tahan dulu perpindahan halamannya
                    const destination = this.href;

                    // Munculkan layar loading
                    loader.classList.remove("hidden");
                    
                    // Trik untuk memicu animasi transisi dari hidden ke muncul
                    requestAnimationFrame(() => {
                        loader.classList.remove("opacity-0");
                    });

                    // Pindah ke halaman tujuan setelah animasi loading muncul sempurna (300ms)
                    setTimeout(() => {
                        window.location.href = destination;
                    }, 300);
                }
            });
        });
    });
</script>