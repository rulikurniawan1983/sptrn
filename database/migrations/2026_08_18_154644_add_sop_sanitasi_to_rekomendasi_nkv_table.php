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
        Schema::table('rekomendasi_nkv', function (Blueprint $table) {
            $table->string('sop_sanitasi')->nullable()->after('surat_pernyataan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekomendasi_nkv', function (Blueprint $table) {
            $table->dropColumn('sop_sanitasi');
        });
    }
};
