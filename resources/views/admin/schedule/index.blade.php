<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900">Jadwal Pengukuran</h2>
    </x-slot>

    <div class="p-6 sm:p-8 space-y-6">
        <div class="max-w-4xl space-y-6">

            {{-- Filter Tanggal --}}
            <form method="GET" class="bg-white p-5 rounded-3xl border border-krem-dark/40 shadow-sm flex items-center gap-3">
                <label class="font-semibold text-xs text-gray-700">Pilih Tanggal:</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" class="border-krem-dark/60 rounded-xl text-xs focus:border-coklat focus:ring-coklat bg-krem-light/30 p-2.5"
                       onchange="this.form.submit()">
            </form>

            <div class="bg-white border border-krem-dark/40 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-[#F4ECE1] text-gray-700 font-semibold border-b border-krem-dark/30">
                            <tr>
                                <th class="px-4 py-3.5">Jam</th>
                                <th class="px-4 py-3.5">No. Booking</th>
                                <th class="px-4 py-3.5">Pelanggan</th>
                                <th class="px-4 py-3.5">Metode</th>
                                <th class="px-4 py-3.5">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-krem-dark/20">
                            @forelse ($bookings as $booking)
                                <tr class="hover:bg-krem-light/40 transition-colors">
                                    <td class="px-4 py-3.5 font-semibold text-coklat">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
                                    <td class="px-4 py-3.5 font-semibold text-gray-900">{{ $booking->booking_code }}</td>
                                    <td class="px-4 py-3.5 font-medium text-gray-800">{{ $booking->user->name }}</td>
                                    <td class="px-4 py-3.5 text-gray-700 whitespace-nowrap">
                                        {{ $booking->measurement_method === 'datang_ke_tempat' ? 'Datang ke Tempat' : 'Di Tempat Pelanggan' }}
                                    </td>
                                    <td class="px-4 py-3.5 whitespace-nowrap">
                                        <span class="px-3.5 py-1.5 rounded-full text-[11px] font-semibold whitespace-nowrap inline-flex items-center justify-center shrink-0 {{ $booking->statusBadgeClasses() }}">
                                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-12 text-center text-gray-400">
                                        Tidak ada jadwal pengukuran di tanggal ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>