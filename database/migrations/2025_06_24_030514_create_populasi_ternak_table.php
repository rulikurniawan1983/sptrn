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
        Schema::create('populasi_ternak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_ternak_populasi_id')->nullable();
            $table->unsignedBigInteger('id_kecamatan')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('rtp')->nullable();
    
            $table->foreign('jenis_ternak_populasi_id')
                  ->references('id')->on('jenis_ternak_populasi')
                  ->onDelete('set null');
            $table->foreign('id_kecamatan')
                  ->references('id')->on('mst_kecamatan')
                  ->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('populasi_ternak');
    }
};
