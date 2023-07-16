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
        //
        Schema::create('gejala_penyakits', function (Blueprint $table) {
            $table->id();
            $table->string('gejala')->index();
            $table->string('penyakit')->index();
            $table->timestamps();
          
            $table->foreign('gejala')->references('kode')->on('gejalas')->onDelete('cascade');
            $table->foreign('penyakit')->references('kode')->on('jenis_penyakits')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('gejala_users');
    }
};
