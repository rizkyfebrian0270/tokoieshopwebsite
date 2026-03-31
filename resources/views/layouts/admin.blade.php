<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - IE Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-900 flex overflow-hidden">

    <div id="admin-page-loader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-gray-50 transition-opacity duration-300 opacity-100">
        <div class="flex flex-col items-center gap-4">
            <div class="w-12 h-12 border-4 border-gray-200 border-t-[#2c3821] rounded-full animate-spin"></div>
            <p class="text-[#2c3821] font-black tracking-widest animate-pulse text-xs">MEMUAT DATA...</p>
        </div>
    </div>
    <aside class="w-64 bg-[#2c3821] text-white h-screen flex flex-col shadow-2xl transition-all z-20">
        <div class="p-6 flex items-center justify-center border-b border-white/10">
            <h1 class="text-2xl font-black tracking-widest text-white">
                IE<span class="text-[#C5D89D]">ADMIN</span>
            </h1>
        </div>
        
        <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
            <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-colors {{ request()->is('admin/dashboard') ? 'bg-white/20 font-bold' : 'text-gray-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="/admin/products" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-colors {{ request()->is('admin/products') ? 'bg-white/20 font-bold' : 'text-gray-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Products
            </a>
            <a href="/admin/categories" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-colors {{ request()->is('admin/categories') ? 'bg-white/20 font-bold' : 'text-gray-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Categories
            </a>
        </nav>

        <div class="p-4 mt-auto border-t border-white/10">
            <button type="button" onclick="confirmLogout()" class="w-full flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-xl transition-colors font-bold group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout Keluar
            </button>
        </div>
    </aside>

    <main class="flex-1 h-screen overflow-y-auto bg-gray-50 flex flex-col">
        <header class="bg-white shadow-sm px-8 py-5 flex justify-between items-center z-10 sticky top-0">
            <h2 class="text-xl font-bold text-gray-800">@yield('header_title', 'Admin Panel')</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-600">Halo, Admin!</span>
                <div class="w-10 h-10 bg-[#C5D89D] text-[#2c3821] rounded-full flex items-center justify-center font-bold shadow-sm">
                    A
                </div>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>

    <div id="logout-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-all duration-300 opacity-0">
        <div id="logout-modal-box" class="bg-white rounded-3xl shadow-2xl w-full max-w-sm p-6 transform scale-90 transition-transform duration-300">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </div>
                
                <h3 class="text-xl font-black text-gray-900 mb-2">Konfirmasi Keluar</h3>
                <p class="text-gray-500 text-sm mb-6 leading-relaxed">Apakah kamu yakin ingin mengakhiri sesi dan keluar dari Admin Panel?</p>
                
                <div class="flex gap-3 w-full">
                    <button onclick="closeLogoutModal()" class="w-1/2 px-4 py-3 rounded-xl border-2 border-gray-100 text-gray-600 font-bold hover:bg-gray-50 transition-colors">Batal</button>
                    
                    <form action="{{ route('logout') }}" method="POST" class="w-1/2">
                        @csrf
                        <button type="submit" class="w-full px-4 py-3 rounded-xl bg-orange-500 text-white font-bold hover:bg-orange-600 shadow-lg shadow-orange-200 transition-colors">Ya, Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-all duration-300 opacity-0">
        <div id="delete-modal-box" class="bg-white rounded-3xl shadow-2xl w-full max-w-sm p-6 transform scale-90 transition-transform duration-300">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 animate-bounce">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                
                <h3 class="text-xl font-black text-gray-900 mb-2">Konfirmasi Hapus</h3>
                <p class="text-gray-500 text-sm mb-6 leading-relaxed">Apakah kamu yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.</p>
                
                <div class="flex gap-3 w-full">
                    <button onclick="closeDeleteModal()" class="w-1/2 px-4 py-3 rounded-xl border-2 border-gray-100 text-gray-600 font-bold hover:bg-gray-50 transition-colors">Batal</button>
                    <button onclick="executeDelete()" class="w-1/2 px-4 py-3 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600 shadow-lg shadow-red-200 transition-colors">Ya, Hapus!</button>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div id="toast-action-success" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 space-x-3 text-gray-600 bg-white rounded-2xl shadow-2xl border border-green-100 transform transition-all duration-500 translate-x-[150%] opacity-0" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-green-500 rounded-xl shadow-inner">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="ms-3">
            <span class="mb-0.5 text-sm font-black text-gray-900 block">Berhasil!</span>
            <span class="text-xs font-medium text-gray-500">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <script>
        // 1. LOGIKA UNTUK POPUP TOAST SUCCESS (Dijalankan otomatis saat halaman dimuat)
        document.addEventListener("DOMContentLoaded", function () {

        const pageLoader = document.getElementById("admin-page-loader");
            if (pageLoader) {
                // A. Sembunyikan layar loading saat halaman selesai dimuat
                setTimeout(() => {
                    pageLoader.classList.add("opacity-0");
                    setTimeout(() => {
                        pageLoader.classList.add("hidden");
                    }, 300); // Tunggu animasi memudar selesai
                }, 150); // Jeda sedikit agar transisi mulus

                // B. Munculkan layar loading saat menekan menu di sidebar
                const links = document.querySelectorAll("a");
                links.forEach(link => {
                    link.addEventListener("click", function (e) {
                        // Pastikan yang diklik adalah link menu (bukan link eksternal atau sekadar '#' anchor)
                        if (
                            this.href &&
                            this.href.startsWith(window.location.origin) &&
                            !this.hasAttribute("target") &&
                            !this.hasAttribute("download") &&
                            !this.href.includes('#')
                        ) {
                            e.preventDefault(); // Tahan dulu perpindahannya
                            const destination = this.href;

                            // Munculkan layar loading kembali
                            pageLoader.classList.remove("hidden");
                            requestAnimationFrame(() => {
                                pageLoader.classList.remove("opacity-0");
                            });

                            // Pindah halaman setelah layar loading tertutup sempurna
                            setTimeout(() => {
                                window.location.href = destination;
                            }, 300);
                        }
                    });
                });
            }

        const toast = document.getElementById("toast-action-success");
            if (toast) {
                setTimeout(() => {
                    toast.classList.remove("translate-x-[150%]", "opacity-0");
                    toast.classList.add("translate-x-0", "opacity-100");
                }, 100);

                setTimeout(() => {
                    toast.classList.remove("translate-x-0", "opacity-100");
                    toast.classList.add("translate-x-[150%]", "opacity-0");
                }, 3500);
            }
        });

        // =========================================================================
        // 2. LOGIKA UNTUK MODAL TAMBAH & HAPUS (Ditaruh di luar agar tombol bisa memanggilnya)
        // =========================================================================
        
        // Fungsi Modal Tambah/Edit
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Fungsi Modal Konfirmasi Hapus
        let formToDelete = null;
        const deleteModal = document.getElementById('delete-modal');
        const modalBox = document.getElementById('delete-modal-box');

        function confirmDelete(button) {
            formToDelete = button.closest('form');
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
            
            requestAnimationFrame(() => {
                deleteModal.classList.remove('opacity-0');
                modalBox.classList.remove('scale-90');
                modalBox.classList.add('scale-100');
            });
        }

        function closeDeleteModal() {
            deleteModal.classList.add('opacity-0');
            modalBox.classList.remove('scale-100');
            modalBox.classList.add('scale-90');
            
            setTimeout(() => {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                formToDelete = null; 
            }, 300); 
        }

        // ==========================================
        // 3. LOGIKA UNTUK MODAL LOGOUT
        // ==========================================
        const logoutModal = document.getElementById('logout-modal');
        const logoutModalBox = document.getElementById('logout-modal-box');

        function confirmLogout() {
            // Tampilkan modal
            logoutModal.classList.remove('hidden');
            logoutModal.classList.add('flex');
            
            // Efek transisi masuk
            requestAnimationFrame(() => {
                logoutModal.classList.remove('opacity-0');
                logoutModalBox.classList.remove('scale-90');
                logoutModalBox.classList.add('scale-100');
            });
        }

        function closeLogoutModal() {
            // Efek transisi keluar
            logoutModal.classList.add('opacity-0');
            logoutModalBox.classList.remove('scale-100');
            logoutModalBox.classList.add('scale-90');
            
            // Sembunyikan setelah animasi selesai
            setTimeout(() => {
                logoutModal.classList.add('hidden');
                logoutModal.classList.remove('flex');
            }, 300); 
        }

        function executeDelete() {
            if (formToDelete) {
                formToDelete.submit(); 
            }
        }
    </script>
</body>
</html>