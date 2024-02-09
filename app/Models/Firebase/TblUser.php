<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;

class TblUser
{

  private $database;
  private $table_name = "tbl_user";
  private $field = ['id_user', 'username_user', 'password_user', 'email_user', 'tipe_user'];
  private $level_user = [
    [
      'key' => 0,
      'value' => 'Admin'
    ],
    [
      'key' => 1,
      'value' => 'Kepala Sekolah'
    ],
    [
      'key' => 2,
      'value' => 'Guru'
    ],
    [
      'key' => 3,
      'value' => 'Orang Tua'
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

  public function getDataUsers()
  {
    $dataUsers = $this->getDatabase()->getValue();
    return $dataUsers;
  }
}
