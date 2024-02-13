<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPendaftaranAwal;
use App\Models\Firebase\TblPendaftaranUlang;
use App\Models\Firebase\TblSiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tblPendaftaranAwal = (new TblPendaftaranAwal)->getDataAll() ?? [];
        $tblPendaftaranUlang = (new TblPendaftaranUlang)->getDataAll() ?? [];
        if (count($tblPendaftaranAwal) > 0) unset($tblPendaftaranAwal['last_update']);
        if (count($tblPendaftaranUlang) > 0) unset($tblPendaftaranUlang['last_update']);
        $dataPendaftaranAwal = array_values(array_filter($tblPendaftaranAwal, function ($item) {
            return $item['status_pendaftaran_awal'] === "0";
        }));
        $dataPendaftaranUlang = array_values(array_filter($tblPendaftaranUlang, function ($item) {
            return $item['status_pendaftaran_ulang'] === "0";
        }));

        $tblSiswa = (new TblSiswa)->getDataAll() ?? [];
        if (count($tblSiswa) > 0) unset($tblSiswa['last_update']);
        $dataSiswa = array_values(array_filter($tblSiswa, function ($item) {
            return $item['status_siswa'] === "1";
        }));

        $dataPendaftaranAwalS = array_values(array_filter($tblPendaftaranAwal, function ($item) {
            return $item['status_pendaftaran_awal'] === "1";
        }));
        $dataPendaftaranUlangS = array_values(array_filter($tblPendaftaranUlang, function ($item) {
            return $item['status_pendaftaran_ulang'] === "1";
        }));



        $data = [
            'menu' => 'dashboard',
            'dataProses' => count($dataPendaftaranAwal) + count($dataPendaftaranUlang),
            'dataSiswa' => count($dataSiswa),
            'dataPendaftaranAwal' => count($dataPendaftaranAwalS),
            'dataPendaftaranUlang' => count($dataPendaftaranUlangS)
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
