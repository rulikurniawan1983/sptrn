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
        Schema::create('peternakan_produksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peternakan')->nullable()->index();
            $table->date("tanggal_produksi_dari")->nullable();
            $table->date("tanggal_produksi_sampai")->nullable();
            $table->bigInteger('jumlah_kandang')->nullable();
            $table->unsignedBigInteger('jumlah_kandang_id_satuan')->nullable()->index();
            $table->bigInteger('jumlah_populasi')->nullable();
            $table->unsignedBigInteger('jumlah_populasi_id_satuan')->nullable()->index();
            $table->bigInteger('jumlah_produksi')->nullable();
            $table->unsignedBigInteger('jumlah_produksi_id_satuan')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_peternakan')->references('id')->on('peternakan');
            $table->foreign('jumlah_kandang_id_satuan')->references('id')->on('mst_satuan');
            $table->foreign('jumlah_populasi_id_satuan')->references('id')->on('mst_satuan');
            $table->foreign('jumlah_produksi_id_satuan')->references('id')->on('mst_satuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peternakan_produksi');
    }
};
