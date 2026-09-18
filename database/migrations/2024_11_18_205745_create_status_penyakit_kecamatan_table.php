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
        Schema::create('status_penyakit_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_status_penyakit')->nullable()->index();
            $table->unsignedBigInteger('id_kecamatan')->nullable()->index();

            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_status_penyakit')->references('id')->on('status_penyakit');
            $table->foreign('id_kecamatan')->references('id')->on('mst_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_penyakit_kecamatan');
    }
};
