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
        Schema::create('status_penyakit_kasus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_status_penyakit')->nullable()->index();
            $table->integer("tahun")->nullable();
            $table->unsignedBigInteger('id_status_penyakit_hewan')->nullable()->index();
            $table->integer("jumlah_terinfeksi")->nullable();
            $table->integer("jumlah_sembuh")->nullable();
            $table->integer("jumlah_mati")->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_status_penyakit')->references('id')->on('status_penyakit');
            $table->foreign('id_status_penyakit_hewan')->references('id')->on('status_penyakit_hewan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_penyakit_kasus');
    }
};
