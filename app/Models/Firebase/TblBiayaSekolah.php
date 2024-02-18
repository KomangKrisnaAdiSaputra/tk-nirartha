<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblBiayaSekolah
{

  private $database;
  private $table_name = "tbl_biaya_sekolah";
  private $field = ['id_biaya', 'id_siswa', 'nama_biaya', 'bulan_biaya', 'tahun_biaya', 'tgl_pembayaran_biaya', 'status_biaya', 'foto_pembayaran'];
  private $status = [
    [
      'key' => "0",
      'value' => "Proses"
    ],
    [
      'key' => "1",
      'value' => "Selesai"
    ],
    [
      'key' => "2",
      'value' => "In-Valid"
    ],
  ];

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

  public function getAllData()
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
