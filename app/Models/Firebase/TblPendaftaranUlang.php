<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblPendaftaranUlang
{

  private $database;
  private $table_name = "tbl_pendaftaran_ulang";
  private $field = ['id_pendaftaran_ulang', 'id_siswa', 'tgl_pendaftaran_ulang', 'bukti_pembayaran_pendaftaran_ulang', 'catatan_pendaftaran_ulang', 'status_pendaftaran_ulang'];
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
