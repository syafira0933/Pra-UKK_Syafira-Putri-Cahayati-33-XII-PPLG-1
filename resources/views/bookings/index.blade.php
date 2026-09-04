<x-app-layout>
    <div class="py-10 bg-transparent min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 animate-fade-in-up">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-emas tracking-wider uppercase mb-1">
                        <i class="fa-solid fa-scissors"></i> Simpatik Tailor
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 tracking-tight">Riwayat Pemesanan Busana</h1>
                    <p class="text-xs text-gray-400 mt-1">Daftar seluruh pesanan kustom & permak busana Anda.</p>
                </div>
                <a href="{{ route('bookings.create') }}"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-coklat-dark to-coklat text-white font-semibold px-5 py-3 rounded-2xl text-xs shadow hover:shadow-md transition-all self-start sm:self-auto shrink-0">
                    <i class="fa-solid fa-plus"></i>
                    <span>Pesan Jahitan Baru</span>
                </a>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs flex items-center gap-3 shadow-xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Filter Tabs & List Container --}}
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-krem-dark/40 shadow-sm space-y-6" x-data="{ filter: 'semua' }">
                
                {{-- Tabs Filter --}}
                <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-krem-dark/20">
                    <button @click="filter = 'semua'"
                            :class="filter === 'semua' ? 'bg-coklat text-white font-semibold shadow-2xs' : 'bg-krem/40 text-gray-600 hover:bg-krem hover:text-coklat'"
                            class="text-xs px-4 py-2.5 rounded-xl transition-colors">
                        Semua Pesanan
                    </button>

                    <button @click="filter = 'menunggu_konfirmasi'"
                            :class="filter === 'menunggu_konfirmasi' ? 'bg-amber-600 text-white font-semibold shadow-2xs' : 'bg-amber-50 text-amber-800 hover:bg-amber-100'"
                            class="text-xs px-4 py-2.5 rounded-xl transition-colors">
                        Menunggu Konfirmasi
                    </button>

                    <button @click="filter = 'diproses'"
                            :class="filter === 'diproses' ? 'bg-sky-600 text-white font-semibold shadow-2xs' : 'bg-sky-50 text-sky-800 hover:bg-sky-100'"
                            class="text-xs px-4 py-2.5 rounded-xl transition-colors">
                        Sedang Diproses
                    </button>

                    <button @click="filter = 'selesai'"
                            :class="filter === 'selesai' ? 'bg-emerald-600 text-white font-semibold shadow-2xs' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100'"
                            class="text-xs px-4 py-2.5 rounded-xl transition-colors">
                        Selesai
                    </button>
                </div>

                {{-- Booking Cards --}}
                <div class="space-y-3">
                    @forelse ($bookings as $booking)
                        @php
                            $group = match ($booking->status) {
                                'menunggu_konfirmasi' => 'menunggu_konfirmasi',
                                'selesai' => 'selesai',
                                default => 'diproses',
                            };
                        @endphp

                        <a href="{{ route('bookings.show', $booking) }}"
                           x-show="filter === 'semua' || filter === '{{ $group }}'"
                           x-transition
                           class="group flex flex-col sm:flex-row sm:items-center justify-between p-5 rounded-2xl border border-krem-dark/30 hover:border-emas/50 hover:bg-krem-light/40 transition-all gap-4 shadow-2xs">
                            
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-krem to-krem-dark/30 text-coklat flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition-transform shadow-2xs">
                                    <i class="{{ $booking->clothingIcon() }}"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold text-gray-900 text-sm group-hover:text-coklat transition-colors">
                                            {{ $booking->booking_code }}
                                        </span>
                                        <span class="text-[10px] font-semibold text-coklat bg-krem/70 px-2 py-0.5 rounded-md border border-krem-dark/30">
                                            {{ $booking->quantity }} Pcs
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $booking->clothing_type === 'Lainnya' ? $booking->other_clothing_type : $booking->clothing_type }}
                                        &bull;
                                        {{ $booking->service_type === 'Lainnya' ? $booking->other_service_type : $booking->service_type }}
                                        &bull;
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between sm:justify-end gap-3 pt-3 sm:pt-0 border-t sm:border-t-0 border-krem-dark/20 shrink-0">
                                <span class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap inline-flex items-center justify-center shrink-0 {{ $booking->statusBadgeClasses() }}">
                                    {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                </span>
                                <i class="fa-solid fa-chevron-right text-xs text-gray-300 group-hover:text-coklat transition-colors"></i>
                            </div>

                        </a>
                    @empty
                        <div class="text-center py-16 px-4 bg-[#FAF7F2]/60 rounded-2xl border border-dashed border-krem-dark/40">
                            <div class="w-14 h-14 rounded-full bg-white text-coklat flex items-center justify-center text-xl mx-auto mb-3 shadow-xs border border-krem-dark/30">
                                <i class="fa-solid fa-inbox"></i>
                            </div>
                            <h3 class="font-semibold text-gray-900 text-sm">Belum Ada Riwayat Pesanan</h3>
                            <p class="text-gray-400 text-xs mt-1 mb-6">Mulai pesan busana kustom pertama Anda sekarang.</p>
                            <a href="{{ route('bookings.create') }}"
                               class="inline-flex items-center gap-2 bg-coklat text-white px-5 py-2.5 rounded-xl text-xs font-semibold hover:bg-coklat-dark transition-colors shadow">
                                <i class="fa-solid fa-plus"></i> Pesan Sekarang
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination Links --}}
                @if (method_exists($bookings, 'links') && $bookings->hasPages())
                    <div class="pt-4 border-t border-krem-dark/20">
                        {{ $bookings->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>