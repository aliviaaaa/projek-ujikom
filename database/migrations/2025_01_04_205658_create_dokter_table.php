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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id('kd_dokter');
            $table->foreignId('kd_poli')->constrained('polikliniks', 'kd_poli')->onDelete('cascade');
            $table->foreignId('kd_user')->constrained('users', 'kd_user')->onDelete('cascade');
            $table->string('nm_dokter');
            $table->string('SIP');
            $table->date('tgl_kunjungan');
            $table->string('tmpat_lhr');
            $table->string('no_tlp');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
