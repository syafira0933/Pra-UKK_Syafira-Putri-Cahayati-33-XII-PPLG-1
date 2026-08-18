<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar booking milik pelanggan yang sedang login.
     */
    public function index(): View
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan formulir pembuatan booking baru.
     */
    public function create(): View
    {
        return view('bookings.create');
    }

    /**
     * Mengecek jumlah booking aktif pada tanggal tertentu (digunakan oleh permintaan AJAX).
     */
    public function checkDate(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $maxQuota = 5;

        // Mengabaikan booking yang sudah selesai, dibatalkan, atau ditolak
        $count = Booking::where('booking_date', $request->date)
            ->whereNotIn('status', ['selesai', 'dibatalkan', 'ditolak'])
            ->count();

        return response()->json([
            'count' => $count,
            'max_quota' => $maxQuota,
            'is_full' => $count >= $maxQuota,
        ]);
    }

    /**
     * Menyimpan data booking baru ke database.
     */
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Generate kode booking unik dengan jaminan tidak duplikat
        do {
            $bookingCode = 'BOOK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Booking::where('booking_code', $bookingCode)->exists());

        $data['booking_code'] = $bookingCode;
        $data['user_id'] = auth()->id();
        $data['status'] = 'menunggu_konfirmasi';

        // Simpan gambar acuan jika ada & rollback gambar jika terjadi kesalahan
        $uploadedPath = null;
        try {
            if ($request->hasFile('reference_image')) {
                $uploadedPath = $request->file('reference_image')->store('references', 'public');
                $data['reference_image'] = $uploadedPath;
            }

            Booking::create($data);

            return redirect()
                ->route('bookings.index')
                ->with('success', 'Booking berhasil dikirim! Nomor booking kamu: ' . $data['booking_code']);
        } catch (\Exception $e) {
            // Hapus gambar dari storage jika gagal menyimpan data ke basis data
            if ($uploadedPath && Storage::disk('public')->exists($uploadedPath)) {
                Storage::disk('public')->delete($uploadedPath);
            }

            return back()
                ->withInput()
                ->with('error', 'Gagal membuat booking. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan detail satu data booking.
     */
    public function show(Booking $booking): View
    {
        // Pastikan pelanggan hanya dapat melihat booking miliknya sendiri
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }
}

