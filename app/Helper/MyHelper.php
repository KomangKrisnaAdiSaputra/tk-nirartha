<?php

use App\Models\Firebase\TblKelas;
use App\Models\Firebase\TblPegawai;
use App\Models\Firebase\TblPendaftaranAwal;
use App\Models\Firebase\TblPendaftaranUlang;
use App\Models\Firebase\TblPengumuman;
use App\Models\Firebase\TblSiswa;
use App\Models\Firebase\TblUser;
use Carbon\Carbon;

function getDataPegawai($id)
{
  return (new TblPegawai)->getDataPegawai($id);
}

function getDataUser($id)
{
  return (new TblUser)->getOneDataUser($id);
}

function getStatusPengumuman($key)
{
  $data = (new TblPengumuman)->get('status');
  return array_values(array_filter($data, function ($item) use ($key) {
    return (string) $item['key'] === $key;
  }))[0]['value'];
}

function getJkPegawai($key)
{
  $data = (new TblPegawai)->get('jk');
  return array_values(array_filter($data, function ($item) use ($key) {
    return (string) $item['key'] === $key;
  }))[0]['value'];
}

function getDataKelas($key)
{
  $data = (new TblKelas)->getDataKelas($key);
  return $data;
}

function getDataSiswa($key)
{
  $data = (new TblSiswa)->getOneData($key);
  return $data;
}

function getStatusSiswa($key)
{
  $data = (new TblSiswa)->get('status');
  return array_values(array_filter($data, function ($item) use ($key) {
    return $item['key'] === $key;
  }))[0]['value'];
}

function getStatusDaftarAwal($key)
{
  $data = (new TblPendaftaranAwal)->get('status');
  return array_values(array_filter($data, function ($item) use ($key) {
    return $item['key'] === $key;
  }))[0]['value'];
}

function getDataPendaftaran($key)
{
  $data = (new TblPendaftaranUlang)->getOneData($key);
  return $data;
}

function getDataAgama()
{
  return ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'];
}

function getDataPendidikan()
{
  return ['TK', 'SMP', 'SMA', 'Sarjana', 'Magister', 'Doctor'];
}

function carbon($parse = false, $key = null, $format_before = null, $format_after = null)
{
  return ($parse) ?  Carbon::createFromFormat($format_before, $key)->isoFormat($format_after) : Carbon::now();
}

function golDarah()
{
  return ['A', 'B', 'AB', 'O'];
}
