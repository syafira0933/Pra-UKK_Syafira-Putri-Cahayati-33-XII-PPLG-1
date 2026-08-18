<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('clothing_type');
            $table->string('other_clothing_type')->nullable();

            $table->string('service_type');
            $table->string('other_service_type')->nullable();

            $table->unsignedInteger('quantity');

            $table->enum('measurement_method', ['datang_ke_tempat', 'di_tempat_pelanggan']);
            $table->string('address')->nullable();

            $table->date('booking_date');
            $table->time('booking_time');

            $table->string('reference_image')->nullable();
            $table->text('notes')->nullable();

            $table->enum('status', [
                'menunggu_konfirmasi',
                'dikonfirmasi',
                'pengukuran_selesai',
                'sedang_dijahit',
                'siap_diambil',
                'selesai',
            ])->default('menunggu_konfirmasi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};