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

        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
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