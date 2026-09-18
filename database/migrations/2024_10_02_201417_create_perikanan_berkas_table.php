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
        Schema::create('perikanan_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perikanan')->nullable()->index();
            $table->unsignedBigInteger('id_berkas_perikanan')->nullable()->index();
            $table->string("nama")->nullable();
            $table->date("tanggal_berkas")->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_perikanan')->references('id')->on('perikanan');
            $table->foreign('id_berkas_perikanan')->references('id')->on('mst_berkas_perikanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perikanan_berkas');
    }
};
