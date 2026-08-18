<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda utama (atau mengalihkan admin ke dashboard admin).
     */
    public function index(Request $request): View|RedirectResponse
    {
        // 1. Cek role admin terlebih dahulu sebelum query ke database
        if ($request->user()?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. Query database hanya dijalankan jika pengakses BUKAN admin
        $services = Service::latest()->take(3)->get();

        // 3. Tampilkan view 'home' jika sudah login, atau 'welcome' jika guest
        $viewName = auth()->check() ? 'home' : 'welcome';

        return view($viewName, compact('services'));
    }
}

