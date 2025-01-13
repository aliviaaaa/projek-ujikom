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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id('no_rm');
            $table->foreignId('kd_tindakan')->constrained('tindakans', 'kd_tindakan')->onDelete('cascade');
            $table->foreignId('kd_obat')->constrained('obats', 'kd_obat')->onDelete('cascade');
            $table->foreignId('kd_user')->nullable()->constrained('users', 'kd_user')->onDelete('cascade');
            $table->foreignId('no_pasien')->constrained('pasiens', 'no_pasien')->onDelete('cascade');
            $table->string('diagnosa');
            $table->text('resep');
            $table->text('keluhan');
            $table->date('tgl_pemeriksaan');
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
