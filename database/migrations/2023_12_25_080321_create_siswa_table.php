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
        Schema::create('tbl_siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->unsignedBigInteger('id_orang_tua');
            $table->foreign('id_orang_tua')->references('id_orang_tua')->on('tbl_orang_tua');
            $table->unsignedBigInteger('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('tbl_kelas');
            $table->string('no_induk', 15);
            $table->year('tahun_angkatan');
            $table->date('tgl_diterima_siswa');
            $table->tinyInteger('status_siswa');
            $table->string('nama_siswa', 100);
            $table->string('agama_siswa', 30);
            $table->tinyInteger('jk_siswa');
            $table->string('tmp_lahir_siswa', 50);
            $table->date('tgl_lahir_siswa');
            $table->tinyInteger('status_anak_siswa');
            $table->tinyInteger('jumlah_saudara');
            $table->string('foto_siswa', 255);
            $table->string('bahasa_siswa', 30);
            $table->string('golongan_darah_siswa', 20);
            $table->string('kartu_kia_siswa', 255);
            $table->string('warga_negara_siswa', 50);
            $table->string('kelurahan_siswa', 50);
            $table->string('kabupaten_siswa', 50);
            $table->string('provinsi_siswa', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_siswa');
    }
};
