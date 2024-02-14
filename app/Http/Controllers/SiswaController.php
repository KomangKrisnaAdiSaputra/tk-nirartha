<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblKelas;
use App\Models\Firebase\TblSiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'siswa';
        $data = (new TblSiswa)->getDataAll() ?? [];

        if (count($data) > 0) unset($data['last_update']);
        return view('backoffice.siswa.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = 'siswa';
        $data = (new TblSiswa)->getOneData($id);
        $dataKelas = (new TblKelas)->getDataAllKelas() ?? [];
        if (count($dataKelas) > 0) unset($dataKelas['last_update']);
        $statusSiswa = (new TblSiswa)->get('status');
        return view('backoffice.siswa.form.edit', compact('menu', 'data', 'dataKelas', 'statusSiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tblSiswa = (new TblSiswa);

        $getDataSiswa = $tblSiswa->getOneData($id);

        $getDataSiswa['id_kelas'] = $request->id_kelas;
        $getDataSiswa['status_siswa'] = $request->status_siswa;
        $getDataSiswa['tgl_diterima_siswa'] = $request->tgl_diterima_siswa;

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblSiswa->getOneData($dataLastUpdate['key']);
        if ($cek === null) {
            $tblSiswa->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblSiswa->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $dataUpdate = [
            $id => $getDataSiswa
        ];

        $tblSiswa->getDatabase()->update($dataUpdate);
        session()->put('siswa', $dataLastUpdate['value']);
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function cek()
    {
        $cek = (new TblSiswa)->getDataAll() ?? [];
        if (isset($cek['last_update'])) {
            if (session()->has('siswa')) {
                if (session('siswa') != $cek['last_update']) {
                    session()->put('siswa', $cek['last_update']);
                    return true;
                }
            } else {
                session()->put('siswa', $cek['last_update']);
            }
        }
        return false;
    }
}
