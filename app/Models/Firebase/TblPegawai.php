<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblPegawai
{

  private $database;
  private $table_name = "tbl_pegawai";
  private $field = ['id_pegawai', 'id_user', 'nama_pegawai', 'telp_pegawai', 'jk_pegawai', 'foto_pegawai', 'created_at', 'updated_at'];
  private $jk = [
    [
      'key' => "1",
      'value' => 'Wanita'
    ],
    [
      'key' => "2",
      'value' => 'Laki-Laki'
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

  public function getDatabase($updates = false, $id = null)
  {
    $table_name = !$updates ? $this->table_name : $this->table_name . '/' . $id;
    return $this->database->getReference($table_name);
  }

  public function getDataAllPegawai()
  {
    $data = $this->getDatabase()->getValue();
    return $data;
  }

  public function getDataPegawai($id)
  {
    $dataPegawai = $this->getDatabase()->getChild($id)->getValue();
    return $dataPegawai;
  }
}
