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
        Schema::create('penyakits', function (Blueprint $table) {
            $table->string('kode', 30)->primary();
            $table->string('name');
            $table->string('deskipsi');
            $table->string('solusi');
            $table->timestamps();
        });
        $this->initializeNodes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakits');
    }

    
    public function initializeNodes(){
        DB::table('penyakits')->insert([[
            'kode' => 'P123',
            'name' => 'TBC A',
            'deskipsi' => 'CASFF',
            'solusi' => 'VGSERTB',
        ],[
            'kode' => 'P124',
            'name' => 'TBC E',
            'deskipsi' => 'CEVRCG',
            'solusi' => 'VRHEBY',
        ]]);
    }
};
