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
        Schema::create('kasuses', function (Blueprint $table) {
            $table->id();
            $table->string('gejala')->index();
            $table->string('penyakit')->index();
            $table->timestamps();
          
            $table->foreign('gejala')->references('kode')->on('gejalas')->onDelete('cascade');
            $table->foreign('penyakit')->references('kode')->on('penyakits')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasus');
    }
};