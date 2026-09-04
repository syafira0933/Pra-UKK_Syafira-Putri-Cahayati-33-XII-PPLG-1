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
        'fabric_source',
        'quantity',
        'measurement_method',
        'address',
        'booking_date',
        'booking_time',
        'reference_image',
        'notes',
        'status',
        'lingkar_dada',
        'lingkar_pinggang',
        'lingkar_pinggul',
        'lebar_bahu',
        'panjang_lengan',
        'panjang_pakaian',
        'panjang_celana_rok',
        'catatan_pengukuran',
    ];

    /**
     * Mendapatkan label sumber bahan/kain yang dipilih pelanggan.
     */
    public function fabricSourceLabel(): string
    {
        return match ($this->fabric_source) {
            'dari_penjahit' => 'Bahan dari Penjahit / Toko',
            default => 'Bawa Kain / Bahan Sendiri',
        };
    }

    /**
     * Mengecek apakah booking sudah memiliki data hasil pengukuran busana.
     */
    public function hasMeasurements(): bool
    {
        return !empty($this->lingkar_dada) ||
               !empty($this->lingkar_pinggang) ||
               !empty($this->lingkar_pinggul) ||
               !empty($this->lebar_bahu) ||
               !empty($this->panjang_lengan) ||
               !empty($this->panjang_pakaian) ||
               !empty($this->panjang_celana_rok) ||
               !empty($this->catatan_pengukuran);
    }

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
        $base = 'whitespace-nowrap inline-flex items-center justify-center shrink-0 border ';
        return $base . match ($this->status) {
            'menunggu_konfirmasi' => 'bg-amber-50 text-amber-700 border-amber-200/80',
            'dikonfirmasi', 'pengukuran_selesai', 'sedang_dijahit' => 'bg-blue-50 text-blue-700 border-blue-200/80',
            'siap_diambil' => 'bg-teal-50 text-teal-700 border-teal-200/80',
            'selesai' => 'bg-green-50 text-green-700 border-green-200/80',
            default => 'bg-gray-100 text-gray-700 border-gray-200',
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