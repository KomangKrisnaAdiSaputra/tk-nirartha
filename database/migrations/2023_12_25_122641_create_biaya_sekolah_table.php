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
        Schema::create('tbl_biaya_sekolah', function (Blueprint $table) {
            $table->id('id_pendaftaran_ulang');
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id_siswa')->on('tbl_siswa');
            $table->string('nama_biaya', 100);
            $table->tinyinteger('bulan_biaya');
            $table->year('tahun_biaya');
            $table->date('tgl_pembayaran_biaya');
            $table->string('bukti_pembayaran_biaya', 255);
            $table->string('catatan_pembayaran_biaya', 100);
            $table->tinyInteger('status_pembayaran_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_biaya_sekolah');
    }
};
