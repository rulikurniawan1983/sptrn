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
        Schema::create('users_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->nullable()->index();
            $table->unsignedBigInteger('id_kecamatan')->nullable()->index();

            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('id_kecamatan')->references('id')->on('mst_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_kecamatan');
    }
};
