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
        if (Schema::hasTable('peternakan')) {
            if (!Schema::hasColumn('peternakan', 'lat')) {
                Schema::table('peternakan', function (Blueprint $table) {
                    $table->string('lat')->nullable();
                    $table->string('long')->nullable();
                    $table->integer('radius')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peternakan', function (Blueprint $table) {
            //
        });
    }
};
