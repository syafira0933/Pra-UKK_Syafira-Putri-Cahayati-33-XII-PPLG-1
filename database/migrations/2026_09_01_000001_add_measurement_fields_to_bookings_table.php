<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('lingkar_dada')->nullable()->after('notes');
            $table->string('lingkar_pinggang')->nullable()->after('lingkar_dada');
            $table->string('lingkar_pinggul')->nullable()->after('lingkar_pinggang');
            $table->string('lebar_bahu')->nullable()->after('lingkar_pinggul');
            $table->string('panjang_lengan')->nullable()->after('lebar_bahu');
            $table->string('panjang_pakaian')->nullable()->after('panjang_lengan');
            $table->string('panjang_celana_rok')->nullable()->after('panjang_pakaian');
            $table->text('catatan_pengukuran')->nullable()->after('panjang_celana_rok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'lingkar_dada',
                'lingkar_pinggang',
                'lingkar_pinggul',
                'lebar_bahu',
                'panjang_lengan',
                'panjang_pakaian',
                'panjang_celana_rok',
                'catatan_pengukuran',
            ]);
        });
    }
};
