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
        Schema::create('user_penyakits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user')->index();
            $table->string('penyakit')->index();
            $table->boolean('persentase');
            $table->timestamps();
          });
        Schema::table('user_penyakits', function($table)
        {
            $table->foreign('user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('penyakit')
            ->references('kode')
            ->on('jenis_penyakits')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
