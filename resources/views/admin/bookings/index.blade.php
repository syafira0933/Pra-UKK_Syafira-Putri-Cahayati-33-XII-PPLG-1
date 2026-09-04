<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900">Data Booking</h2>
    </x-slot>

    <div class="p-6 sm:p-8 space-y-6">

        @if (session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs flex items-center gap-3 shadow-xs">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Search & Filter --}}
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <div class="relative flex-1 min-w-[240px] max-w-xs">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nomor booking atau nama..."
                       class="w-full pl-10 text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-white p-3">
            </div>
            <select name="status" onchange="this.form.submit()"
                    class="text-xs border-krem-dark/60 rounded-xl focus:border-coklat focus:ring-coklat bg-white py-3 pl-4 pr-10 min-w-[190px] shadow-2xs font-medium text-gray-800">
                <option value="">Semua Status</option>
                @foreach (['menunggu_konfirmasi', 'dikonfirmasi', 'pengukuran_selesai', 'sedang_dijahit', 'siap_diambil', 'selesai'] as $status)
                    <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-gradient-to-r from-coklat-dark to-coklat text-white text-xs font-semibold px-6 py-3 rounded-xl hover:shadow-md transition-all shadow-xs">
                Cari
            </button>
            @if (request('search') || request('status'))
                <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-gray-400 hover:text-coklat self-center px-2">Reset</a>
            @endif
        </form>

        <div class="bg-white border border-krem-dark/40 rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left">
                    <thead class="bg-[#F4ECE1] text-gray-700 font-semibold border-b border-krem-dark/30">
                        <tr>
                            <th class="px-4 py-3.5">No. Booking</th>
                            <th class="px-4 py-3.5">Pelanggan</th>
                            <th class="px-4 py-3.5">No. HP</th>
                            <th class="px-4 py-3.5">Jenis Pakaian</th>
                            <th class="px-4 py-3.5">Jumlah</th>
                            <th class="px-4 py-3.5 whitespace-nowrap">Tanggal</th>
                            <th class="px-4 py-3.5 whitespace-nowrap">Status</th>
                            <th class="px-4 py-3.5 text-right whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-krem-dark/20">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-krem-light/40 transition-colors">
                                <td class="px-4 py-3.5 font-semibold text-gray-900 whitespace-nowrap">{{ $booking->booking_code }}</td>
                                <td class="px-4 py-3.5 font-medium text-gray-800 whitespace-nowrap">{{ $booking->user->name }}</td>
                                <td class="px-4 py-3.5 text-gray-600 whitespace-nowrap">{{ $booking->user->phone ?? '-' }}</td>
                                <td class="px-4 py-3.5 text-gray-700 whitespace-nowrap">{{ $booking->clothing_type === 'Lainnya' ? $booking->other_clothing_type : $booking->clothing_type }}</td>
                                <td class="px-4 py-3.5 font-medium text-gray-800 whitespace-nowrap">{{ $booking->quantity }}</td>
                                <td class="px-4 py-3.5 text-gray-600 whitespace-nowrap">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="px-3.5 py-1.5 rounded-full text-[11px] font-semibold whitespace-nowrap inline-flex items-center justify-center shrink-0 {{ $booking->statusBadgeClasses() }}">
                                        {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-right">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="text-xs font-semibold text-coklat hover:text-coklat-dark hover:underline">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-12 text-center text-gray-400">
                                    Tidak ada booking yang cocok dengan pencarian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>