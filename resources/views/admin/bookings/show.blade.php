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

                <div class="mb-2">
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-semibold {{ $booking->statusBadgeClasses() }}">
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

                <hr class="my-3 border-krem-dark/20">

                {{-- Form ubah status --}}
                <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking) }}" class="flex flex-wrap items-center gap-3 pt-1">
                    @csrf
                    @method('PATCH')
                    <label class="font-semibold text-xs text-gray-900">Ubah Status:</label>
                    <select name="status" class="text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-white p-2.5">
                        @foreach (['menunggu_konfirmasi', 'dikonfirmasi', 'pengukuran_selesai', 'sedang_dijahit', 'siap_diambil', 'selesai'] as $status)
                            <option value="{{ $status }}" {{ $booking->status === $status ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-gradient-to-r from-coklat-dark to-coklat text-white text-xs font-semibold px-5 py-2.5 rounded-xl hover:shadow-md transition-all shadow-xs">
                        Update Status
                    </button>
                </form>

                {{-- Hapus booking --}}
                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus booking ini?')" class="pt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline text-xs font-medium">Hapus Booking</button>
                </form>

                <div class="pt-4 border-t border-krem-dark/20">
                    <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-coklat hover:underline">
                        &larr; Kembali ke Data Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>