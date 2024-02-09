<?php

use App\Models\Firebase\TblPegawai;
use App\Models\Firebase\TblPengumuman;

function getDataPegawai($id)
{
  return (new TblPegawai)->getDataPegawai($id);
}

function getStatusPengumuman($key)
{
  $data = (new TblPengumuman)->get('status');
  return array_values(array_filter($data, function ($item) use ($key) {
    return $item['key'] === $key;
  }))[0]['value'];
}
