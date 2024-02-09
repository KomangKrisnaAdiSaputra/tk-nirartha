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
        Schema::create('tbl_pendaftaran_ulang', function (Blueprint $table) {
            $table->id('id_pendaftaran_ulang');
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id_siswa')->on('tbl_siswa');
            $table->date('tgl_pendaftaran_ulang');
            $table->string('bukti_pembayaran_pendaftaran_ulang', 255);
            $table->string('catatan_pendaftaran_ulang', 100);
            $table->tinyInteger('status_pendaftaran_ulang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pendaftaran_ulang');
    }
};
