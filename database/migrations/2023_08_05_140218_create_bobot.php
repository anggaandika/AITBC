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
        Schema::create('bobots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('nilai', 15)->default(0.0);
            $table->timestamps();
        });
        $this->initializeNodes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot');
    }
    
    public function initializeNodes(){
        DB::table('bobots')->insert([[
            'name' => 'rendah',
            'nilai' => '0.39',
        ],[
            'name' => 'sedang',
            'nilai' => '0.79',
        ],[
            'name' => 'tinggi',
            'nilai' => '1.0',
        ],]);
    }
};
