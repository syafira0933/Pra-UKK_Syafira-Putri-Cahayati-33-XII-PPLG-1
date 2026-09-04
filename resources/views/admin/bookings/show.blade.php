<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            Detail Booking — {{ $booking->booking_code }}
        </h2>
    </x-slot>

    <div class="py-8 bg-[#FAF7F2] min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 sm:p-8 border border-krem-dark/40 shadow-sm rounded-3xl space-y-4">

                @if (session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs flex items-center gap-3 shadow-xs">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs flex items-center gap-3 shadow-xs">
                        <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <div class="mb-2">
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap inline-flex items-center justify-center shrink-0 {{ $booking->statusBadgeClasses() }}">
                        {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </div>

                <div class="space-y-1.5 text-xs text-gray-700">
                    <p><span class="font-semibold text-gray-900">Pelanggan:</span> {{ $booking->user->name }}</p>
                    <p><span class="font-semibold text-gray-900">Email:</span> {{ $booking->user->email }}</p>
                    <p><span class="font-semibold text-gray-900">No. HP:</span> {{ $booking->user->phone ?? '-' }}</p>
                </div>

                <hr class="my-3 border-krem-dark/20">

                <div class="space-y-1.5 text-xs text-gray-700">
                    <p><span class="font-semibold text-gray-900">Jenis Pakaian:</span>
                        {{ $booking->clothing_type === 'Lainnya' ? $booking->other_clothing_type : $booking->clothing_type }}
                    </p>
                    <p><span class="font-semibold text-gray-900">Jenis Layanan:</span>
                        {{ $booking->service_type === 'Lainnya' ? $booking->other_service_type : $booking->service_type }}
                    </p>
                    <p><span class="font-semibold text-gray-900">Sumber Bahan Kain:</span>
                        <span class="font-semibold text-amber-800">{{ $booking->fabricSourceLabel() }}</span>
                    </p>
                    <p><span class="font-semibold text-gray-900">Jumlah Pakaian:</span> {{ $booking->quantity }}</p>
                    <p><span class="font-semibold text-gray-900">Metode Pengukuran:</span>
                        {{ $booking->measurement_method === 'datang_ke_tempat' ? '🏪 Datang ke Tempat Penjahit' : '🏠 Pengukuran di Tempat Pelanggan' }}
                    </p>

                    @if ($booking->address)
                        <p><span class="font-semibold text-gray-900">Alamat:</span> {{ $booking->address }}</p>
                    @endif

                    <p><span class="font-semibold text-gray-900">Tanggal:</span> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                    <p><span class="font-semibold text-gray-900">Jam:</span> {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</p>

                    @if ($booking->notes)
                        <p><span class="font-semibold text-gray-900">Catatan:</span> {{ $booking->notes }}</p>
                    @endif
                </div>

                @if ($booking->reference_image)
                    <div class="pt-2">
                        <span class="font-semibold text-xs text-gray-900 block mb-2">Referensi Model:</span>
                        <img src="{{ Storage::url($booking->reference_image) }}" class="w-48 rounded-2xl border border-krem-dark/40 shadow-xs">
                    </div>
                @endif

                <div class="pt-4 border-t border-krem-dark/20 space-y-5">
                    {{-- Form Input / Edit Ukuran Busana (Khusus Admin) --}}
                    <div class="p-5 bg-amber-50/50 border border-amber-200/80 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-ruler-combined text-amber-700 text-sm"></i>
                                <h3 class="font-semibold text-xs text-gray-900 uppercase tracking-wider">
                                    Form Pengukuran Busana (Khusus Admin / Penjahit)
                                </h3>
                            </div>
                            @if ($booking->hasMeasurements())
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">
                                    <i class="fa-solid fa-check text-[9px] mr-1"></i> Ukuran Terisi
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-800">
                                    Belum Diisi
                                </span>
                            @endif
                        </div>
                        <p class="text-[11px] text-gray-600">
                            Isi detail ukuran hasil pengukuran di tempat atau toko. Data ukuran ini akan otomatis tampil di halaman detail spesifikasi order pelanggan.
                        </p>

                        <form method="POST" action="{{ route('admin.bookings.updateMeasurements', $booking) }}" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            {{-- Kategori 1: Ukuran Baju / Atasan --}}
                            <div class="p-4 bg-white rounded-2xl border border-amber-200/70 space-y-3 shadow-2xs">
                                <div class="flex items-center gap-2 border-b border-krem-dark/20 pb-2">
                                    <i class="fa-solid fa-shirt text-amber-700 text-xs"></i>
                                    <span class="font-semibold text-xs text-gray-900 uppercase tracking-wider">1. Ukuran Baju / Atasan</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3.5 text-xs">
                                    <div>
                                        <label class="block font-medium text-gray-700 mb-1 whitespace-nowrap">Lingkar Dada</label>
                                        <input type="text" name="lingkar_dada" value="{{ old('lingkar_dada', $booking->lingkar_dada) }}"
                                               placeholder="misal: 92 cm"
                                               class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-[#FAF7F2]/50 p-2.5 shadow-2xs font-normal">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-gray-700 mb-1 whitespace-nowrap">Lebar Bahu</label>
                                        <input type="text" name="lebar_bahu" value="{{ old('lebar_bahu', $booking->lebar_bahu) }}"
                                               placeholder="misal: 38 cm"
                                               class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-[#FAF7F2]/50 p-2.5 shadow-2xs font-normal">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-gray-700 mb-1 whitespace-nowrap">Panjang Lengan</label>
                                        <input type="text" name="panjang_lengan" value="{{ old('panjang_lengan', $booking->panjang_lengan) }}"
                                               placeholder="misal: 55 cm"
                                               class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-[#FAF7F2]/50 p-2.5 shadow-2xs font-normal">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-gray-700 mb-1 whitespace-nowrap">Panjang Baju</label>
                                        <input type="text" name="panjang_pakaian" value="{{ old('panjang_pakaian', $booking->panjang_pakaian) }}"
                                               placeholder="misal: 110 cm"
                                               class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-[#FAF7F2]/50 p-2.5 shadow-2xs font-normal">
                                    </div>
                                    <div class="sm:col-span-2 md:col-span-1">
                                        <label class="block font-medium text-gray-700 mb-1 whitespace-nowrap">Lingkar Pinggang Pakaian</label>
                                        <input type="text" name="lingkar_pinggang" value="{{ old('lingkar_pinggang', $booking->lingkar_pinggang) }}"
                                               placeholder="misal: 76 cm"
                                               class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-[#FAF7F2]/50 p-2.5 shadow-2xs font-normal">
                                    </div>
                                </div>
                            </div>

                            {{-- Kategori 2: Ukuran Celana / Rok (Bawahan) --}}
                            <div class="p-4 bg-white rounded-2xl border border-amber-200/70 space-y-3 shadow-2xs">
                                <div class="flex items-center gap-2 border-b border-krem-dark/20 pb-2">
                                    <i class="fa-solid fa-vest text-amber-700 text-xs"></i>
                                    <span class="font-semibold text-xs text-gray-900 uppercase tracking-wider">2. Ukuran Celana / Rok (Bawahan)</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 text-xs">
                                    <div>
                                        <label class="block font-medium text-gray-700 mb-1 whitespace-nowrap">Lingkar Pinggul</label>
                                        <input type="text" name="lingkar_pinggul" value="{{ old('lingkar_pinggul', $booking->lingkar_pinggul) }}"
                                               placeholder="misal: 98 cm"
                                               class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-[#FAF7F2]/50 p-2.5 shadow-2xs font-normal">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-gray-700 mb-1 whitespace-nowrap">Panjang Celana / Rok</label>
                                        <input type="text" name="panjang_celana_rok" value="{{ old('panjang_celana_rok', $booking->panjang_celana_rok) }}"
                                               placeholder="misal: 95 cm"
                                               class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-[#FAF7F2]/50 p-2.5 shadow-2xs font-normal">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block font-medium text-xs text-gray-700 mb-1">Catatan Tambahan Ukuran</label>
                                <textarea name="catatan_pengukuran" rows="2"
                                          placeholder="Catatan khusus mengenai ukuran, bentuk kerah, lipatan, dll."
                                          class="w-full text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-white p-2.5 shadow-2xs font-normal">{{ old('catatan_pengukuran', $booking->catatan_pengukuran) }}</textarea>
                            </div>

                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-amber-700 hover:bg-amber-800 text-white text-xs font-semibold px-5 py-2.5 rounded-xl transition-all shadow-xs">
                                <i class="fa-solid fa-floppy-disk text-xs"></i>
                                <span>Simpan Data Pengukuran</span>
                            </button>
                        </form>
                    </div>

                    {{-- Form ubah status --}}
                    <div class="p-4 bg-[#FAF7F2] border border-krem-dark/30 rounded-2xl space-y-3">
                        <label for="status-select" class="block font-semibold text-xs text-gray-900">
                            Ubah Status Pengerjaan:
                        </label>
                        <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking) }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            @csrf
                            @method('PATCH')
                            <select id="status-select" name="status" class="text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-white p-3 pr-8 min-w-[200px] shadow-2xs font-medium text-gray-800">
                                @foreach (['menunggu_konfirmasi', 'dikonfirmasi', 'pengukuran_selesai', 'sedang_dijahit', 'siap_diambil', 'selesai'] as $status)
                                    <option value="{{ $status }}" {{ $booking->status === $status ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-gradient-to-r from-coklat-dark to-coklat hover:from-coklat hover:to-coklat-dark text-white text-xs font-semibold px-5 py-3 rounded-xl hover:shadow-md transition-all shadow-xs shrink-0">
                                Update Status
                            </button>
                        </form>
                    </div>

                    {{-- Action Footer --}}
                    <div class="flex items-center justify-between pt-1">
                        <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-coklat hover:text-coklat-dark hover:underline inline-flex items-center gap-1">
                            &larr; Kembali ke Data Booking
                        </a>

                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-700 hover:underline inline-flex items-center gap-1">
                                <i class="fa-solid fa-trash-can text-xs"></i> Hapus Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>