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
        Schema::create('status_penyakit', function (Blueprint $table) {
            $table->id();
            $table->string("nama")->nullable();
            $table->string("status_penyelesaian")->nullable();
            $table->unsignedBigInteger('id_jenis_penyakit')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_jenis_penyakit')->references('id')->on('mst_jenis_penyakit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_penyakit');
    }
};
