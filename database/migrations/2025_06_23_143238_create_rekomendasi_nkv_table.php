<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekomendasi_nkv', function (Blueprint $table) {
            $table->id();
            $table->string("nama")->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('nama_tempat_usaha')->nullable();
            $table->text('alamat_usaha')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();

            $table->string('nib')->nullable(); // file
            $table->string('surat_permohonan')->nullable(); // file
            $table->string('data_umum')->nullable(); // file
            $table->string('surat_pernyataan')->nullable(); // file

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
        Schema::dropIfExists('rekomendasi_nkv');
    }
};
