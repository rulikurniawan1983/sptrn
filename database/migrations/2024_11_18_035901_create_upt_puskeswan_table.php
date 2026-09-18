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
        if (!Schema::hasTable('upt_puskeswan')) {
            Schema::create('upt_puskeswan', function (Blueprint $table) {
                $table->id();

                // Todo: Identitas
                $table->string("nama")->nullable();
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
                $table->foreign('id_status_verifikasi')->references('id')->on('status_verifikasi');
                $table->foreign('id_kecamatan')->references('id')->on('mst_kecamatan');
                $table->foreign('id_kelurahan')->references('id')->on('mst_desa');
                // Todo: End Foreign Key
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upt_puskeswan');
    }
};
