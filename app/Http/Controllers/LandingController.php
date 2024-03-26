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
        $tblPengumuman = ((new TblPengumuman))->getDataPengumuman() ?? [];
        if (count($tblPengumuman) > 0) unset($tblPengumuman['last_update']);
        $dataPengumuman = array_values(array_filter($tblPengumuman, function ($item) {
            return $item['status_pengumuman'] === "1";
        }));

        $data = [
            'menu' => 'pengumuman',
            'pengumuman' => $dataPengumuman
        ];
        return view('frontoffice.pengumuman', $data);
    }
    public function kegiatan()
    {

        $kegiatan = [
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar1.jpg'),
                'title' => "Kegiatan 1",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar2.jpg'),
                'title' => "Kegiatan 2",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar3.jpg'),
                'title' => "Kegiatan 3",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar4.jpg'),
                'title' => "Kegiatan 4",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar5.jpg'),
                'title' => "Kegiatan 5",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar6.jpg'),
                'title' => "Kegiatan 6",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar7.jpg'),
                'title' => "Kegiatan 7",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
            [
                'image' => asset('image/landingPages/Kegiatan/Gambar8.jpg'),
                'title' => "Kegiatan 8",
                'author' => "Admin",
                'date' => "26 Maret 2024"
            ],
        ];

        $data = [
            'menu' => 'kegiatan',
            'kegiatan' => $kegiatan
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
