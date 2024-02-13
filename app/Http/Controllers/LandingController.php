<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPegawai;
use App\Models\Firebase\TblPengumuman;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use App\Models\Firebase\TblUser;

class LandingController extends Controller
{

    public function index()
    {
        $tblPengumuman = ((new TblPengumuman))->getDataPengumuman() ?? [];
        if (count($tblPengumuman) > 0) unset($tblPengumuman['last_update']);
        $dataPengumuman = array_values(array_filter($tblPengumuman, function ($item) {
            return $item['status_pengumuman'] === "1";
        }));

        $tblPegawai = ((new TblPegawai))->getDataAllPegawai() ?? [];
        if (count($tblPegawai) > 0) unset($tblPegawai['last_update']);

        $data = [
            'menu' => 'beranda',
            'pengumuman' => $dataPengumuman,
            'pegawai' => $tblPegawai
        ];
        return view('frontoffice.index', $data);
    }
    public function profil()
    {
        $data = [
            'menu' => 'profil'
        ];
        return view('frontoffice.profil', $data);
    }
    public function galeri()
    {
        $data = [
            'menu' => 'galeri'
        ];
        return view('frontoffice.galeri', $data);
    }
    public function pengumuman()
    {
        $data = [
            'menu' => 'pengumuman'
        ];
        return view('frontoffice.pengumuman', $data);
    }
    public function kegiatan()
    {
        $data = [
            'menu' => 'kegiatan'
        ];
        return view('frontoffice.kegiatan', $data);
    }
    public function kontak()
    {
        $data = [
            'menu' => 'kontak'
        ];
        return view('frontoffice.kontak', $data);
    }
}
