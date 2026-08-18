<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan ringkasan statistik dan grafik pada dashboard admin.
     */
    public function index(): View
    {
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $totalBooking = Booking::count();
        $bookingHariIni = Booking::whereDate('booking_date', today())->count();
        $menungguKonfirmasi = Booking::where('status', 'menunggu_konfirmasi')->count();
        $sedangDijahit = Booking::where('status', 'sedang_dijahit')->count();
        $selesai = Booking::where('status', 'selesai')->count();

        // Data untuk grafik: jumlah booking per bulan pada tahun berjalan
        $bookingPerBulan = Booking::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as jumlah')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        // Susun data 12 bulan penuh agar bulan tanpa transaksi tetap bernilai 0
        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $chartData = [];

        foreach ($namaBulan as $index => $nama) {
            $chartData[] = $bookingPerBulan[$index + 1] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalPelanggan',
            'totalBooking',
            'bookingHariIni',
            'menungguKonfirmasi',
            'sedangDijahit',
            'selesai',
            'namaBulan',
            'chartData'
        ));
    }
}