<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use App\Models\Firebase\TblUser;

class LandingController extends Controller
{

    public function index()
    {
        $data = [
            'menu' => 'beranda'
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
