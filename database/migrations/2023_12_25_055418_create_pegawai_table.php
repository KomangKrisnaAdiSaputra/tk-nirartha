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
        Schema::create('tbl_pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('tbl_user');
            $table->string('nama_pegawai', 100);
            $table->string('telp_pegawai', 13);
            $table->tinyInteger('jk_pegawai');
            $table->string('alamat_pegawai', 255);
            $table->string('foto_pegawai', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pegawai');
    }
};
