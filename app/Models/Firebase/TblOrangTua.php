<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblOrangTua
{

  private $database;
  private $table_name = "tbl_orang_tua";
  private $field = ['id_orang_tua', 'id_user', 'nama_ayah', 'tmp_lahir_ayah', 'tgl_lahir_ayah', 'agama_ayah', 'pendidikan_terakhir_ayah', 'pekerjaan_ayah', 'telp_ayah', 'nama_ibu', 'tmp_lahir_ibu', 'tgl_lahir_ibu', 'agama_ibu', 'pendidikan_terakhir_ibu', 'pekerjaan_ibu', 'telp_ibu'];

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
