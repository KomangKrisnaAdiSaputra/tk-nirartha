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
        Schema::create('tbl_pendaftaran_awal', function (Blueprint $table) {
            $table->id('id_pendaftaran_awal');
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id_siswa')->on('tbl_siswa');
            $table->date('tgl_pendaftaran_awal');
            $table->string('bukti_pembayaran_pendaftaran_awal', 255);
            $table->string('catatan_pendaftaran_awal', 100);
            $table->tinyInteger('status_pendaftaran_awal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pendaftaran_awal');
    }
};
