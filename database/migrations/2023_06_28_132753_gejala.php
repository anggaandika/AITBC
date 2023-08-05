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
            $table->timestamps();
        });
        $this->initializeNodes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gejalas');
    }
    
    public function initializeNodes(){
        DB::table('gejalas')->insert(
        [
            [
                'kode' => 'A209',
                'name' => 'batuk',
            ],[
                'kode' => 'A210',
                'name' => 'gatal',
            ],[
                'kode' => 'A212',
                'name' => 'mata merah',
            ]
            ]
        );
    }
};
