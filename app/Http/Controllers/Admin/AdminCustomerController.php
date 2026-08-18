<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class AdminCustomerController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan beserta jumlah booking mereka.
     */
    public function index(): View
    {
        $customers = User::where('role', 'pelanggan')
            ->withCount('bookings')
            ->latest()
            ->get();

        return view('admin.customers.index', compact('customers'));
    }
}