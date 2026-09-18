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
        Schema::create('jenis_ternak_produksi', function (Blueprint $table) {
            $table->id();
            $table->string("nama")->nullable();
            $table->unsignedBigInteger('jenis_produksi_id')->nullable();
            $table->foreign('jenis_produksi_id')->references('id')->on('jenis_produksi')->onDelete('set null');

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
        Schema::dropIfExists('jenis_ternak_produksi');
    }
};
