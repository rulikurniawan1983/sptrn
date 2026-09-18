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
        Schema::create('praktek_dokter_hewan_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_praktek_dokter_hewan')->nullable()->index();
            $table->unsignedBigInteger('id_berkas_keswan')->nullable()->index();
            $table->string("nama")->nullable();
            $table->date("tanggal_berkas")->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_praktek_dokter_hewan')->references('id')->on('praktek_dokter_hewan');
            $table->foreign('id_berkas_keswan')->references('id')->on('mst_berkas_keswan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praktek_dokter_hewan_berkas');
    }
};
