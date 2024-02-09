<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblPengumuman
{

  private $database;
  private $table_name = "tbl_pengumuman";
  private $field = ['id_pengumuman', 'id_pegawai', 'isi_pengumuman', 'tgl_pengumuman', 'status_pengumuman'];
  private $status = [
    [
      'key' => 0,
      'value' => 'Non-Aktif'
    ],
    [
      'key' => 1,
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

  public function getDataPengumuman()
  {
    $dataUsers = $this->getDatabase()->getValue();
    return $dataUsers;
  }

  public function getOneDataPengumuman($id)
  {
    $dataPengumuman = $this->getDatabase()->getChild($id)->getValue();
    return $dataPengumuman;
  }
}
