<nav class="fixed top-6 left-0 right-0 z-50 px-4 flex justify-center pointer-events-none">
    <div class="relative bg-white/80 backdrop-blur-xl shadow-lg shadow-gray-200/50 border border-white rounded-3xl md:rounded-full px-6 py-3 md:px-8 md:py-4 flex flex-wrap items-center justify-between w-full max-w-5xl pointer-events-auto transition-all duration-300">
        
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
        
        <div class="flex items-center gap-3">
            <a href="/cart" class="relative flex items-center justify-center w-10 h-10 md:w-11 md:h-11 rounded-full bg-gray-50 hover:bg-[#2c3821] hover:text-white text-[#2c3821] border border-gray-100 transition-all duration-300 group shadow-sm hover:shadow-md hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                
                <span id="cartBadge" class="absolute -top-1.5 -right-1.5 hidden bg-red-500 text-white text-[10px] rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-md border-2 border-white transform transition-transform duration-300">
                    0
                </span>
            </a>

            <button id="mobileMenuBtn" class="md:hidden flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 text-[#2c3821] border border-gray-100 hover:bg-gray-100 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <div id="mobileMenu" class="w-full hidden flex-col gap-4 pt-4 mt-2 border-t border-gray-100 md:hidden">
            <a href="/" class="block text-center text-sm font-bold text-gray-600 hover:text-[#2c3821] py-2">HOME</a>
            <a href="/tentang-kami" class="block text-center text-sm font-bold text-gray-600 hover:text-[#2c3821] py-2">TENTANG KAMI</a>
            <a href="/kontak" class="block text-center text-sm font-bold text-gray-600 hover:text-[#2c3821] py-2">KONTAK</a>
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
        // Mobile Menu Toggle
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
        });

        // Cart Badge
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

        updateCartBadge();
        window.addEventListener('storage', updateCartBadge);

        // Page Loader
        const loader = document.getElementById("page-loader");
        setTimeout(() => {
            loader.classList.add("opacity-0");
            setTimeout(() => {
                loader.classList.add("hidden");
            }, 500);
        }, 300);

        const links = document.querySelectorAll("a");
        links.forEach(link => {
            link.addEventListener("click", function (e) {
                if (
                    this.href && 
                    this.href.startsWith(window.location.origin) && 
                    !this.hasAttribute("target") && 
                    !this.hasAttribute("download") &&
                    !this.href.includes('#') 
                ) {
                    e.preventDefault();
                    const destination = this.href;
                    loader.classList.remove("hidden");
                    requestAnimationFrame(() => {
                        loader.classList.remove("opacity-0");
                    });
                    setTimeout(() => {
                        window.location.href = destination;
                    }, 300);
                }
            });
        });
    });
</script>