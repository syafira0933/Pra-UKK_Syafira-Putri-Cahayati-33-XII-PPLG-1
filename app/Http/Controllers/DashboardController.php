<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk pelanggan.
     */
    public function index(?Request $request = null): View
    {
        $request = $request ?? request();
        $userId = $request->user()->id;

        // Query tunggal untuk mengambil seluruh statistik booking pelanggan
        $stats = Booking::where('user_id', $userId)
            ->selectRaw("
                COUNT(*) as total,
                COUNT(CASE WHEN status = 'menunggu_konfirmasi' THEN 1 END) as pending,
                COUNT(CASE WHEN status IN ('dikonfirmasi', 'pengukuran_selesai', 'sedang_dijahit', 'siap_diambil') THEN 1 END) as processing,
                COUNT(CASE WHEN status = 'selesai' THEN 1 END) as completed
            ")
            ->first();

        $totalBooking = $stats->total ?? 0;
        $menungguKonfirmasi = $stats->pending ?? 0;
        $diproses = $stats->processing ?? 0;
        $selesai = $stats->completed ?? 0;

        // Query kedua untuk mengambil 5 booking terbaru milik pelanggan
        $bookingTerbaru = Booking::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBooking',
            'menungguKonfirmasi',
            'diproses',
            'selesai',
            'bookingTerbaru'
        ));
    }
}

