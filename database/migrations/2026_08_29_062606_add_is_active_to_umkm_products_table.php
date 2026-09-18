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
        Schema::table('umkm_products', function (Blueprint $table) {
            $table->tinyInteger('is_active')->default(0)->after('foto_produk')->comment('0: Menunggu Verifikasi, 1: Aktif / Terverifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkm_products', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
