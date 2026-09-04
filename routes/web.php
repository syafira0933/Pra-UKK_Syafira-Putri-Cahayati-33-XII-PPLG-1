<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama / landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route khusus pengguna terautentikasi (authenticated users)
Route::middleware('auth')->group(function () {
    // Redirect dashboard sesuai role pengguna
    Route::get('/dashboard', function (Request $request) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return app(DashboardController::class)->index($request);
    })->name('dashboard');

    // Manajemen profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fitur booking khusus pelanggan
    // Route check-date WAJIB didefinisikan sebelum Route::resource
    Route::get('/bookings/check-date', [BookingController::class, 'checkDate'])->name('bookings.checkDate');
    Route::resource('bookings', BookingController::class);

    // Fitur area khusus administrator
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('services', AdminServiceController::class);
        Route::get('/schedule', [AdminScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');

        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::patch('/bookings/{booking}/measurements', [AdminBookingController::class, 'updateMeasurements'])->name('bookings.updateMeasurements');
        Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
    });
});

require __DIR__ . '/auth.php';