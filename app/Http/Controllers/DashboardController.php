<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPendaftaranAwal;
use App\Models\Firebase\TblPendaftaranUlang;
use App\Models\Firebase\TblSiswa;
use App\Models\Firebase\TblUser;
use Carbon\Carbon;
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

    function dataDaftarUlang()
    {
        $tblPendaftaranUlang = (new TblPendaftaranUlang)->getDataAll() ?? [];
        if (count($tblPendaftaranUlang) > 0) unset($tblPendaftaranUlang['last_update']);

        for ($i = -1; $i < 11; $i++) {
            $bulan = Carbon::now()->addMonths($i)->format('m-Y');

            $dataDaftar = array_values(array_filter($tblPendaftaranUlang, function ($item) use ($bulan) {
                return  Carbon::createFromFormat('Y-m-d', (string) $item['tgl_pendaftaran_ulang'])->format('m-Y') === $bulan;
            }));
            $data[] = count($dataDaftar);
        }
        return $data;
        // dd($data);
        // return [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000];
    }

    function dataUser()
    {
        $dataUser = (new TblUser)->getDataUsers() ?? [];
        if (count($dataUser) > 0) unset($dataUser['last_update']);

        $dataPegawai = array_values(array_filter($dataUser, function ($item) {
            return (string) $item['tipe_user'] === '2';
        }));

        $dataOrangTua = array_values(array_filter($dataUser, function ($item) {
            return (string) $item['tipe_user'] === '3';
        }));
        $data = [count($dataPegawai), count($dataOrangTua)];
        return $data;
    }
}
