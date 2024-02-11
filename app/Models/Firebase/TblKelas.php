<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblKelas
{

  private $database;
  private $table_name = "tbl_kelas";
  private $field = ['id_kelas', 'id_pegawai', 'nama_kelas', 'catatan_kelas', 'status_kelas'];
  private $status = [
    [
      'key' => "0",
      'value' => 'Non-Aktif'
    ],
    [
      'key' => "1",
      'value' => 'Aktif'
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

  public function getDataAllKelas()
  {
    $data = $this->getDatabase()->getValue();
    return $data;
  }

  public function getDataKelas($id)
  {
    $data = $this->getDatabase()->getChild($id)->getValue();
    return $data;
  }
}
