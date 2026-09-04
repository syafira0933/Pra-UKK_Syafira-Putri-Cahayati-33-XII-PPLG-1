<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreBookingRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna diizinkan membuat permintaan ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Mendapatkan aturan validasi yang berlaku untuk permintaan ini.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'clothing_type' => 'required|string',
            'other_clothing_type' => 'required_if:clothing_type,Lainnya|nullable|string|max:255',

            'service_type' => 'required|string',
            'other_service_type' => 'required_if:service_type,Lainnya|nullable|string|max:255',

            'fabric_source' => 'required|in:bawa_sendiri,dari_penjahit',

            'quantity' => 'required|integer|min:1',

            'reference_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'notes' => 'nullable|string',

            'measurement_method' => 'required|in:datang_ke_tempat,di_tempat_pelanggan',
            'address' => 'required_if:measurement_method,di_tempat_pelanggan|nullable|string|max:500',

            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ];
    }

    /**
     * Mengonfigurasi instance validator untuk validasi kustom tambahan.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (
                $this->measurement_method === 'di_tempat_pelanggan' &&
                (int) $this->quantity < 15
            ) {
                $validator->errors()->add(
                    'measurement_method',
                    'Pengukuran di tempat pelanggan hanya tersedia untuk pemesanan minimal 15 pakaian.'
                );
            }

            if ($this->booking_date) {
                $maxQuota = 5; // Batas kuota harian booking
                $activeCount = Booking::where('booking_date', $this->booking_date)
                    ->whereNotIn('status', ['selesai', 'dibatalkan', 'ditolak'])
                    ->count();

                if ($activeCount >= $maxQuota) {
                    $validator->errors()->add(
                        'booking_date',
                        "Kuota pemesanan untuk tanggal {$this->booking_date} sudah penuh (Maksimal {$maxQuota} booking per hari). Silakan pilih tanggal lain."
                    );
                }
            }
        });
    }

    /**
     * Mendapatkan pesan kesalahan kustom untuk aturan validasi tertentu.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'other_clothing_type.required_if' => 'Jenis pakaian lainnya wajib diisi.',
            'other_service_type.required_if' => 'Jenis layanan lainnya wajib diisi.',
            'address.required_if' => 'Alamat wajib diisi untuk pengukuran di tempat pelanggan.',
        ];
    }
}