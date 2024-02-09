<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'dashboard'
        ];
        return view('backoffice.index', $data);
    }
    public function tampil_data_kepala_sekolah()
    {
    }
    public function tambah_data_kepala_sekolah()
    {
        $data = [
            'menu' => 'kepala sekolah'
        ];
        return view('backoffice.kepala-sekolah.tambah-kepala-sekolah', $data);
    }
}
