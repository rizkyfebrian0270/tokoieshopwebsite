<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IESHOPP | Hubungi Kami</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#F8FAF5] text-gray-900 font-sans overflow-x-hidden scroll-smooth">

<x-navbar />

<section class="relative min-h-screen flex items-center justify-center px-8 md:px-16 pt-32 pb-24 overflow-hidden">
    
    <div class="absolute top-20 left-0 w-96 h-96 bg-[#C5D89D] rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-[#e6edcc] rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>

    <div class="relative z-10 max-w-6xl mx-auto w-full">
        
        <div class="text-center mb-16">
            <span class="inline-block py-1.5 px-4 rounded-full bg-[#C5D89D] text-[#3f4f30] text-sm font-semibold tracking-wider mb-6 shadow-sm">
                ✨ BANTUAN & DUKUNGAN
            </span>
            <h1 class="text-5xl md:text-[60px] font-black mb-4 leading-[1.1] tracking-tight text-[#2c3821]">
                Hubungi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4b5d3a] to-[#7a935b]">Kami</span>
            </h1>
            <p class="text-lg text-gray-500 font-light max-w-xl mx-auto">Ada pertanyaan atau butuh bantuan? Tim kami siap merespons pesanmu secepatnya.</p>
        </div>

        <div class="grid lg:grid-cols-5 gap-10 md:gap-14 mb-14">

            <div class="lg:col-span-3 bg-white p-10 md:p-12 rounded-[2.5rem] shadow-xl border border-gray-100">
                <h2 class="text-3xl font-bold mb-8 tracking-tight text-gray-900">Kirim Pesan</h2>

                <form class="flex flex-col gap-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                            <input type="text" placeholder="John Doe"
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl p-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2c3821] focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Alamat Email</label>
                            <input type="email" placeholder="john@example.com"
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl p-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2c3821] focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Pesan Anda</label>
                        <textarea rows="5" placeholder="Tuliskan detail pertanyaan atau keluhanmu di sini..."
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl p-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2c3821] focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    <button type="submit"
                        class="mt-4 bg-[#2c3821] hover:bg-black text-white py-4 rounded-full text-lg font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 flex flex-col gap-8">
                <div class="bg-[#2c3821] p-10 rounded-[2.5rem] shadow-xl text-white relative overflow-hidden flex-grow">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                    <h2 class="text-2xl font-bold mb-8 relative z-10">Informasi Kontak</h2>

                    <div class="flex flex-col gap-8 text-base font-light relative z-10">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Alamat Toko</h4>
                                <p class="text-gray-300 leading-relaxed text-sm">Jl. Raya Syeh Quro, Palumbonsari,<br>Kec. Karawang Timur, Karawang,<br>Jawa Barat 41314</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Email Support</h4>
                                <p class="text-gray-300">ieshopp@gmail.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">WhatsApp</h4>
                                <p class="text-gray-300">+62 857-7773-2464</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="mt-12 relative z-10">
                        <a href="https://wa.me/+6285777732464" target="_blank"
                            class="flex items-center justify-center gap-3 w-full bg-[#C5D89D] text-[#2c3821] px-6 py-4 rounded-full text-base font-bold hover:bg-white transition-colors duration-300 shadow-md">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white p-4 md:p-6 rounded-[3rem] shadow-xl border border-gray-100 flex flex-col relative overflow-hidden group">
            
            <div class="px-6 pt-4 pb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 mb-1">Lokasi Toko Fisik Kami</h2>
                    <p class="text-sm text-gray-500">Kunjungi toko kami untuk melihat koleksi secara langsung.</p>
                </div>
                
                <a href="https://maps.google.com/maps?q=M8WF%2B9C4%2C%20Jl.%20Raya%20Syeh%20Quro%2C%20Palumbonsari%2C%20Kec.%20Karawang%20Tim.%2C%20Karawang" target="_blank"
                   class="hidden md:flex items-center gap-2 bg-gray-50 hover:bg-[#2c3821] hover:text-white border border-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-full transition-all duration-300">
                    Buka di Maps &rarr;
                </a>
            </div>

            <div class="w-full h-[400px] md:h-[500px] rounded-[2rem] overflow-hidden bg-gray-100 relative">
                <iframe 
                    src="https://maps.google.com/maps?q=IE+Shop+2,+M8WF%2B9C4,+Jl.+Raya+Syeh+Quro,+Palumbonsari,+Karawang&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="absolute inset-0 w-full h-full object-cover">
                </iframe>
            </div>
            
            <a href="https://maps.google.com/maps?q=M8WF%2B9C4%2C%20Jl.%20Raya%20Syeh%20Quro%2C%20Palumbonsari%2C%20Kec.%20Karawang%20Tim.%2C%20Karawang" target="_blank"
               class="md:hidden mt-4 text-center block w-full bg-[#2c3821] text-white font-bold py-3.5 rounded-2xl transition-all duration-300">
                Buka di Aplikasi Maps
            </a>
            
        </div>

    </div>
</section>

<x-footer />

</body>
</html>