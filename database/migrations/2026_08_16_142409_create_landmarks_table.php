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
        Schema::create('landmarks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('alamat')->nullable();
            $table->text('keterangan')->nullable();

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
        Schema::dropIfExists('landmarks');
    }
};
