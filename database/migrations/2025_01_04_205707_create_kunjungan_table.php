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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id('id_kunjungan');
            $table->foreignId('no_pasien')->constrained('pasiens', 'no_pasien')->onDelete('cascade');
            $table->foreignId('kd_poli')->constrained('polikliniks', 'kd_poli')->onDelete('cascade');
            $table->date('tgl_kunjungan');
            $table->time('jam_kunjungan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungana');
    }
};
