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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id('no_pasien');
            $table->string('nm_pasien');
            $table->string('j_kel'); 
            $table->string('agama');
            $table->text('alamat');
            $table->date('tgl_lhr');
            $table->integer('usia');
            $table->string('no_tlp');
            $table->string('nm_kk');
            $table->string('hub_kel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
