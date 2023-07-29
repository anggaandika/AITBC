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
        // Gejala Penyakit
        Schema::create('gejalas', function (Blueprint $table) {
            $table->string('kode', 30)->primary();
            $table->string('name');
            $table->double('bobot', 15, 8)->nullable()->default(123.4567);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('gejala');
    }
};
