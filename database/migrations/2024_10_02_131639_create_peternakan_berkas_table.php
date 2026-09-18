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
        Schema::create('peternakan_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peternakan')->nullable()->index();
            $table->unsignedBigInteger('id_berkas_peternakan')->nullable()->index();
            $table->string("nama")->nullable();
            $table->date("tanggal_berkas")->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_peternakan')->references('id')->on('peternakan');
            $table->foreign('id_berkas_peternakan')->references('id')->on('mst_berkas_peternakan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peternakan_berkas');
    }
};
