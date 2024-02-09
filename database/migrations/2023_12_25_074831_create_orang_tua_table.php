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
        Schema::create('tbl_orang_tua', function (Blueprint $table) {
            $table->id('id_orang_tua');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('tbl_user');
            $table->string('nama_ayah', 100);
            $table->string('tmp_lahir_ayah', 50);
            $table->date('tgl_lahir_ayah');
            $table->string('agama_ayah', 30);
            $table->string('pendidikan_terakhir_ayah', 100);
            $table->string('pekerjaan_ayah', 100);
            $table->string('telp_ayah', 14);
            $table->string('nama_ibu', 100);
            $table->string('tmp_lahir_ibu', 50);
            $table->date('tgl_lahir_ibu');
            $table->string('agama_ibu', 30);
            $table->string('pendidikan_terakhir_ibu', 100);
            $table->string('pekerjaan_ibu', 100);
            $table->string('telp_ibu', 14);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_orang_tua');
    }
};
