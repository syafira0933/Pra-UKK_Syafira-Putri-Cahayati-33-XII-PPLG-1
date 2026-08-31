<x-app-layout>
    <div class="py-10 bg-transparent min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 animate-fade-in-up">

            {{-- Hero Banner Home (Logged In User) --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-coklat-dark via-[#3D2518] to-coklat rounded-3xl p-8 sm:p-12 text-white shadow-xl border border-emas/25">
                <div class="absolute inset-0 bg-[radial-gradient(#C5A059_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>
                <div class="absolute -right-8 -bottom-8 opacity-15 pointer-events-none animate-float">
                    <i class="fa-solid fa-scissors text-9xl text-white transform -rotate-45"></i>
                </div>

                <div class="relative z-10 text-center max-w-2xl mx-auto space-y-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md text-emas-light text-xs font-semibold tracking-wider uppercase border border-emas/30 animate-pulse-soft">
                        <i class="fa-solid fa-scissors text-emas text-xs"></i> SIMPATIK TAILOR
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-white tracking-tight leading-tight">
                        Penjahit Langganan,<br>
                        <span class="text-emas-light font-semibold">Kini Dipesan Online Secara Praktis</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-krem/90 leading-relaxed font-normal">
                        Pengalaman 10+ tahun melayani lebih dari 1.000 pesanan jahitan kustom. Buat booking baru, tentukan waktu pengukuran, dan pantau status busana Anda langsung dari genggaman.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('bookings.create') }}"
                           class="inline-flex items-center gap-2.5 bg-gradient-to-r from-emas via-emas-light to-emas text-coklat-dark font-semibold px-6 py-3.5 rounded-2xl shadow-md hover:shadow-xl hover:scale-105 active:scale-95 transition-all text-xs tracking-wider uppercase shrink-0 border border-white/40">
                            <i class="fa-solid fa-plus text-xs"></i>
                            <span>Booking Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                <div class="bg-white rounded-3xl p-6 text-center shadow-xs border border-krem-dark/40 card-hover-effect">
                    <p class="text-2xl font-semibold text-coklat">10+</p>
                    <p class="text-xs text-gray-400 font-normal mt-1">Tahun Pengalaman</p>
                </div>
                <div class="bg-white rounded-3xl p-6 text-center shadow-xs border border-krem-dark/40 card-hover-effect">
                    <p class="text-2xl font-semibold text-amber-600">1000+</p>
                    <p class="text-xs text-gray-400 font-normal mt-1">Pesanan Selesai</p>
                </div>
                <div class="bg-white rounded-3xl p-6 text-center shadow-xs border border-krem-dark/40 card-hover-effect">
                    <p class="text-2xl font-semibold text-sky-600">9</p>
                    <p class="text-xs text-gray-400 font-normal mt-1">Kategori Pakaian</p>
                </div>
                <div class="bg-white rounded-3xl p-6 text-center shadow-xs border border-krem-dark/40 card-hover-effect">
                    <p class="text-2xl font-semibold text-emerald-600">100%</p>
                    <p class="text-xs text-gray-400 font-normal mt-1">Dijahit Manual Presisi</p>
                </div>
            </div>

            {{-- Layanan Kami --}}
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-xs border border-krem-dark/40 space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-xs font-semibold text-emas tracking-wider uppercase">Layanan Unggulan</span>
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Spesialis Penjahitan Kami</h2>
                </div>

                @if ($services->isEmpty())
                    <p class="text-center text-xs text-gray-400 py-8">Layanan akan segera diperbarui oleh admin.</p>
                @else
                    <div class="flex overflow-x-auto gap-5 pb-2 pt-1 snap-x snap-mandatory no-scrollbar scroll-smooth [::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]" style="-webkit-overflow-scrolling: touch;">
                        @foreach ($services as $index => $service)
                            <div class="snap-start shrink-0 w-[280px] sm:w-[320px] p-5 rounded-2xl border border-krem-dark/30 bg-krem-light/30 hover:bg-white hover:shadow-md hover:border-emas/50 transition-all card-hover-effect flex flex-col justify-between group/card">
                                <div class="space-y-3">
                                    @if ($service->image)
                                        <div class="w-full h-60 bg-white rounded-xl flex items-center justify-center p-2 border border-krem-dark/20 overflow-hidden group/img">
                                            <img src="{{ Storage::url($service->image) }}" class="h-full w-full object-contain group-hover/img:scale-105 transition-transform duration-300">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-xl bg-krem text-coklat flex items-center justify-center text-lg font-semibold">
                                            <i class="fa-solid fa-shirt"></i>
                                        </div>
                                    @endif
                                    <h3 class="font-semibold text-gray-900 text-sm">{{ $service->name }}</h3>
                                    <p class="text-xs text-gray-500 leading-relaxed font-normal">{{ $service->description }}</p>
                                </div>
                                <div class="pt-4 border-t border-krem-dark/20 mt-4">
                                    <a href="{{ route('bookings.create') }}" class="text-xs font-medium text-coklat hover:text-coklat-dark inline-flex items-center gap-1">
                                        <span>Pesan Layanan Ini</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Alur Pemesanan 4 Langkah --}}
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-xs border border-krem-dark/40 space-y-8">
                <div class="text-center space-y-1">
                    <span class="text-xs font-semibold text-emas tracking-wider uppercase">Langkah Mudah</span>
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Cara Pemesanan</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                    <div class="text-center p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 hover:border-emas/50 transition-all card-hover-effect">
                        <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto mb-3 shadow-xs">
                            1
                        </div>
                        <h4 class="font-semibold text-gray-900 text-xs mb-1">Isi Form Booking</h4>
                        <p class="text-[11px] text-gray-400 leading-relaxed font-normal">Pilih jenis pakaian & unggah foto referensi model.</p>
                    </div>

                    <div class="text-center p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 hover:border-emas/50 transition-all card-hover-effect">
                        <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto mb-3 shadow-xs">
                            2
                        </div>
                        <h4 class="font-semibold text-gray-900 text-xs mb-1">Konfirmasi & Ukur</h4>
                        <p class="text-[11px] text-gray-400 leading-relaxed font-normal">Fitting dilakukan di toko atau home service.</p>
                    </div>

                    <div class="text-center p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 hover:border-emas/50 transition-all card-hover-effect">
                        <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto mb-3 shadow-xs">
                            3
                        </div>
                        <h4 class="font-semibold text-gray-900 text-xs mb-1">Proses Penjahitan</h4>
                        <p class="text-[11px] text-gray-400 leading-relaxed font-normal">Busana dikerjakan secara rapi & teliti.</p>
                    </div>

                    <div class="text-center p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 hover:border-emas/50 transition-all card-hover-effect">
                        <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto mb-3 shadow-xs">
                            4
                        </div>
                        <h4 class="font-semibold text-gray-900 text-xs mb-1">Pantau & Ambil</h4>
                        <p class="text-[11px] text-gray-400 leading-relaxed font-normal">Pantau status real-time lalu ambil busana Anda.</p>
                    </div>
                </div>
            </div>

            {{-- CTA Banner --}}
            <div class="bg-gradient-to-r from-coklat-dark via-coklat to-coklat-light rounded-3xl p-8 sm:p-10 text-white text-center shadow-lg border border-emas/30 relative overflow-hidden">
                <div class="relative z-10 max-w-xl mx-auto space-y-4">
                    <h3 class="text-xl sm:text-2xl font-semibold">Siap Menjahit Pakaian Impian Anda?</h3>
                    <p class="text-xs text-krem/90 leading-relaxed font-normal">Buat booking sekarang untuk mendapatkan kepastian antrean pengukuran dari penjahit kami.</p>
                    <a href="{{ route('bookings.create') }}"
                       class="inline-block bg-white text-coklat-dark font-semibold px-6 py-3 rounded-2xl text-xs hover:bg-krem transition-all hover:scale-105 shadow-md">
                        + Booking Sekarang
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>