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
        Schema::create('praktek_dokter_hewan', function (Blueprint $table) {
            $table->id();
            
            // Todo: Identitas
            $table->string("nama")->nullable();
            $table->unsignedBigInteger('id_kbli')->nullable();
            $table->unsignedBigInteger('id_jenis_usaha')->nullable();
            $table->unsignedBigInteger('id_jenis_keswan')->nullable();
            $table->unsignedBigInteger('id_kecamatan')->nullable();
            $table->unsignedBigInteger('id_kelurahan')->nullable();
            // Todo: End Identitas


            // Todo: Kontak & Alamat
            $table->longText("alamat")->nullable();
            $table->string("kode_pos")->nullable();
            $table->string("no_tlp_1")->nullable();
            $table->string("no_tlp_2")->nullable();
            $table->string("fax")->nullable();
            $table->string("email")->nullable();
            $table->string("website")->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->integer('radius')->nullable();
            // Todo: End Kontak & Alamat


            // Todo: Legalitas
            $table->string("no_badan_hukum")->nullable();
            $table->string("tanggal_badan_hukum")->nullable();
            $table->unsignedBigInteger('id_pengesahan_badan_hukum')->nullable();
            $table->string("tahun_ind_usaha")->nullable();
            $table->string("nama_notaris")->nullable();
            $table->string("npwp", 15)->nullable();

            $table->string("nib")->nullable();
            $table->date("nib_tanggal_terbit")->nullable();
            $table->string("nib_dikeluarkan_oleh")->nullable();
            $table->string("nib_penanggungjawab")->nullable();

            $table->string("surat_izin_tempat_usaha")->nullable();
            $table->date("surat_izin_tempat_usaha_tanggal_terbit")->nullable();
            $table->string("surat_izin_tempat_usaha_dikeluarkan_oleh")->nullable();
            $table->date("surat_izin_tempat_usaha_masa_berlaku")->nullable();
            $table->string("surat_izin_tempat_usaha_penanggungjawab")->nullable();
            // Todo: End Legalitas


            // Todo: Lainnya
            $table->unsignedBigInteger('id_tingkat_resiko')->nullable();
            $table->unsignedBigInteger('id_skala_usaha')->nullable();
            // Todo: End Lainnya


            // Todo: Rinci
            $table->bigInteger('nilai_investasi')->nullable();
            $table->unsignedBigInteger('id_status_permodalan')->nullable();
            $table->bigInteger('luas_tanah')->nullable();
            $table->bigInteger('luas_bangunan')->nullable();
            // Todo: End Rinci


            // Todo: Tenaga Kerja
            $table->bigInteger('tki_pria')->nullable();
            $table->bigInteger('tki_wanita')->nullable();
            $table->bigInteger('tka_pria')->nullable();
            $table->bigInteger('tka_wanita')->nullable();
            // Todo: End Tenaga Kerja


            // Todo: Verifikasi
            $table->unsignedBigInteger('id_status_verifikasi')->nullable();
            $table->text("catatan_verifikasi_petugas")->nullable();
            // Todo: End Verifikasi

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();


            // Todo: Foreign Key
            $table->foreign('id_kbli')->references('id')->on('mst_kbli');
            $table->foreign('id_jenis_usaha')->references('id')->on('mst_jenis_usaha');
            $table->foreign('id_jenis_keswan')->references('id')->on('mst_jenis_keswan');
            $table->foreign('id_kecamatan')->references('id')->on('mst_kecamatan');
            $table->foreign('id_kelurahan')->references('id')->on('mst_desa');

            $table->foreign('id_pengesahan_badan_hukum')->references('id')->on('mst_pengesahan_badan_hukum');

            $table->foreign('id_tingkat_resiko')->references('id')->on('mst_tingkat_resiko');
            $table->foreign('id_skala_usaha')->references('id')->on('mst_skala_usaha');

            $table->foreign('id_status_permodalan')->references('id')->on('mst_status_permodalan');

            $table->foreign('id_status_verifikasi')->references('id')->on('status_verifikasi');
            // Todo: End Foreign Key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praktek_dokter_hewan');
    }
};
