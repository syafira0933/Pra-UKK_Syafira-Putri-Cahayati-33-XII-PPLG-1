<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminScheduleController extends Controller
{
    /**
     * Menampilkan jadwal pengerjaan booking berdasarkan tanggal yang dipilih.
     */
    public function index(Request $request): View
    {
        // Default tampilkan jadwal hari ini, atau tanggal yang dipilih dari filter
        $tanggal = $request->filled('tanggal') ? $request->tanggal : now()->format('Y-m-d');

        $bookings = Booking::with('user')
            ->whereDate('booking_date', $tanggal)
            ->orderBy('booking_time')
            ->get();

        return view('admin.schedule.index', compact('bookings', 'tanggal'));
    }
}