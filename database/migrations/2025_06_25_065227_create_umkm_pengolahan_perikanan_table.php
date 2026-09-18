<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm_pengolahan_perikanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelaku_usaha');
            $table->text('alamat')->nullable();
            $table->unsignedBigInteger('id_desa')->nullable();
            $table->unsignedBigInteger('id_kecamatan')->nullable();
            $table->string('jenis_kegiatan')->nullable();
            $table->string('produk_utama')->nullable();
            $table->integer('jumlah_produksi_bulan')->nullable();
            $table->integer('harga_beli_bahan_baku')->nullable();
            $table->integer('harga_jual_produk')->nullable();
            $table->string('wilayah_pemasaran')->nullable();
            $table->string('legalitas')->nullable();
            $table->string('kendala')->nullable();
            $table->boolean('berkelompok')->nullable();
            $table->string('nama_kelompok')->nullable();
            $table->string('foto_produk')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_kecamatan')->references('id')->on('mst_kecamatan')->onDelete('set null');
            $table->foreign('id_desa')->references('id')->on('mst_desa')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm_pengolahan_perikanan');
    }
}; 