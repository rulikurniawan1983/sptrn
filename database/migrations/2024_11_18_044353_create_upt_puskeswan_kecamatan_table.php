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
        Schema::create('upt_puskeswan_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_upt_puskeswan')->nullable();
            $table->unsignedBigInteger('id_kecamatan')->nullable();

            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_upt_puskeswan')->references('id')->on('upt_puskeswan');
            $table->foreign('id_kecamatan')->references('id')->on('mst_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upt_puskeswan_kecamatan');
    }
};
