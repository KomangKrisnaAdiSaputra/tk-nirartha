<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblSiswa
{

  private $database;
  private $table_name = "tbl_siswa";
  private $field = ['id_orang_tua', 'id_siswa', 'id_kelas', 'no_induk', 'tahun_angkatan', 'tgl_diterima_siswa', 'status_siswa', 'nama_siswa', 'agama_siswa', 'jk_siswa', 'tgl_lahir_siswa', 'tmp_lahir_siswa', 'status_anak_siswa', 'jumlah_saudara_siswa', 'foto_siswa', 'bahasa_siswa', 'golongan_darah', 'kartu_kia_siswa', 'warga_negara_siswa', 'kelurahan_siswa', 'kabupaten_siswa', 'provinsi_siswa'];

  public function __construct()
  {
    $this->database = (new FirebaseDb)->getDatabase();
  }

  public function get($value)
  {
    return $this->$value;
  }

  public function getDatabase($withId = false, $id = null)
  {
    $table_name = !$withId ? $this->table_name : $this->table_name . '/' . $id;
    return $this->database->getReference($table_name);
  }

  public function getDataAll()
  {
    $data = $this->getDatabase()->getValue();
    return $data;
  }

  public function getOneData($id)
  {
    $data = $this->getDatabase()->getChild($id)->getValue();
    return $data;
  }
}
