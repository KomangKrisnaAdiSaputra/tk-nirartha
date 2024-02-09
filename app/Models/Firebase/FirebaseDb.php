<?php

namespace App\Models\Firebase;

use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Factory;

class FirebaseDb
{
  protected $auth, $database;

  public function __construct()
  {
    $factory = (new Factory)
      ->withServiceAccount(__DIR__ . '/serviceAccountKey.json')
      ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

    $this->auth = $factory->createAuth();
    $this->database = $factory->createDatabase();
  }

  public function getAuth()
  {
    return $this->auth;
  }

  public function getDatabase()
  {
    return $this->database;
  }
}
