<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    /**
     * Menampilkan daftar semua booking untuk admin dengan pencarian dan filter.
     */
    public function index(Request $request): View
    {
        $query = Booking::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('booking_code', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan detail satu data booking untuk admin.
     */
    public function show(Booking $booking): View
    {
        $booking->load('user');

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Memperbarui status pengerjaan booking.
     */
    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:menunggu_konfirmasi,dikonfirmasi,pengukuran_selesai,sedang_dijahit,siap_diambil,selesai',
        ]);

        $postMeasurementStatuses = ['pengukuran_selesai', 'sedang_dijahit', 'siap_diambil', 'selesai'];

        // Wajib mengisi form pengukuran sebelum status diubah ke pengukuran_selesai atau tahap berikutnya
        if (in_array($request->status, $postMeasurementStatuses) && !$booking->hasMeasurements()) {
            return redirect()->back()->with('error', 'Gagal memperbarui status! Anda wajib mengisi Form Pengukuran Busana terlebih dahulu sebelum mengubah status menjadi ' . ucwords(str_replace('_', ' ', $request->status)) . '.');
        }

        $updateData = ['status' => $request->status];

        // Jika status dikembalikan ke 'menunggu_konfirmasi' atau 'dikonfirmasi', reset data ukuran busana menjadi kosong
        if (in_array($request->status, ['menunggu_konfirmasi', 'dikonfirmasi'])) {
            $updateData['lingkar_dada'] = null;
            $updateData['lingkar_pinggang'] = null;
            $updateData['lingkar_pinggul'] = null;
            $updateData['lebar_bahu'] = null;
            $updateData['panjang_lengan'] = null;
            $updateData['panjang_pakaian'] = null;
            $updateData['panjang_celana_rok'] = null;
            $updateData['catatan_pengukuran'] = null;
        }

        $booking->update($updateData);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }

    /**
     * Memperbarui data spesifikasi ukuran busana (diisi oleh admin/penjahit).
     */
    public function updateMeasurements(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'lingkar_dada' => 'nullable|string|max:50',
            'lingkar_pinggang' => 'nullable|string|max:50',
            'lingkar_pinggul' => 'nullable|string|max:50',
            'lebar_bahu' => 'nullable|string|max:50',
            'panjang_lengan' => 'nullable|string|max:50',
            'panjang_pakaian' => 'nullable|string|max:50',
            'panjang_celana_rok' => 'nullable|string|max:50',
            'catatan_pengukuran' => 'nullable|string|max:1000',
        ]);

        $hasAnyInput = collect($validated)->filter(fn($val) => !empty(trim($val ?? '')))->isNotEmpty();

        if (!$hasAnyInput) {
            return redirect()->back()->with('error', 'Gagal menyimpan! Harap isi minimal satu kolom spesifikasi ukuran busana.');
        }

        $booking->update($validated);

        // Otomatis ubah status pengerjaan ke 'pengukuran_selesai' jika status masih menunggu konfirmasi / dikonfirmasi
        if (in_array($booking->status, ['menunggu_konfirmasi', 'dikonfirmasi'])) {
            $booking->update(['status' => 'pengukuran_selesai']);
        }

        return redirect()->back()->with('success', 'Spesifikasi ukuran busana berhasil disimpan & status otomatis diperbarui ke Pengukuran Selesai.');
    }

    /**
     * Menghapus data booking dari database.
     */
    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}