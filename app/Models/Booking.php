<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_code',
        'user_id',
        'clothing_type',
        'other_clothing_type',
        'service_type',
        'other_service_type',
        'quantity',
        'measurement_method',
        'address',
        'booking_date',
        'booking_time',
        'reference_image',
        'notes',
        'status',
    ];

    /**
     * Relasi ke model User (1 booking dimiliki oleh 1 user).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan class CSS badge berdasarkan status booking.
     */
    public function statusBadgeClasses(): string
    {
        return match ($this->status) {
            'menunggu_konfirmasi' => 'bg-amber-50 text-amber-700',
            'dikonfirmasi', 'pengukuran_selesai', 'sedang_dijahit' => 'bg-blue-50 text-blue-700',
            'siap_diambil' => 'bg-teal-50 text-teal-700',
            'selesai' => 'bg-green-50 text-green-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    /**
     * Mendapatkan class icon FontAwesome berdasarkan jenis pakaian.
     */
    public function clothingIcon(): string
    {
        return match ($this->clothing_type) {
            'Kebaya', 'Dress', 'Blouse' => 'fa-solid fa-person-dress',
            'Jas', 'Kemeja', 'Seragam' => 'fa-solid fa-shirt',
            'Rok', 'Celana' => 'fa-solid fa-vest',
            'Pakaian Anak' => 'fa-solid fa-child-reaching',
            default => 'fa-solid fa-shirt',
        };
    }
}