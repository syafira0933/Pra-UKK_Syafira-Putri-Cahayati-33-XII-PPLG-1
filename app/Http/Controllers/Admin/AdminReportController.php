<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminReportController extends Controller
{
    /**
     * Menampilkan laporan rekapitulasi booking bulanan untuk admin.
     */
    public function index(): View
    {
        $totalBooking = Booking::count();
        $bookingSelesai = Booking::where('status', 'selesai')->count();

        $bookingPerBulan = Booking::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as jumlah')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('admin.reports.index', compact('totalBooking', 'bookingSelesai', 'bookingPerBulan', 'namaBulan'));
    }
}