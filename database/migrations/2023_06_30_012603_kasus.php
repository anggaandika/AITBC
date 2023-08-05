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
            $table->float('bobot', 15)->default(0.0);
            $table->timestamps();
        
            $table->foreign('gejala')->references('kode')->on('gejalas')->onDelete('cascade');
            $table->foreign('penyakit')->references('kode')->on('penyakits')->onDelete('cascade');
        });
        // $this->initializeNodes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasuses');
    }

    public function initializeNodes(){
        DB::table('kasuses')->insert([[
            'gejala' => 'A209',
            'penyakit' => 'A209',
            'bobot' => '0.3',
        ],[
            'gejala' => 'A210',
            'penyakit' => 'P124',
            'bobot' => '0.6',
        ],[
            'gejala' => 'A211',
            'penyakit' => 'P124',
            'bobot' => '0.5',
        ],[
            'gejala' => 'A211',
            'penyakit' => 'P124',
            'bobot' => '0.5',
        ],[
            'gejala' => 'A210',
            'penyakit' => 'P123',
            'bobot' => '0.2',
        ],[
            'gejala' => 'A211',
            'penyakit' => 'P123',
            'bobot' => '0.7',
        ],[
            'gejala' => 'A211',
            'penyakit' => 'P123',
            'bobot' => '0.9',
        ]]);
    }
};
