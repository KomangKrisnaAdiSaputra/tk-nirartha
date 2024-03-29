<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPendaftaranAwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendaftaranAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pendaftaran awal';
        $data = [];
        return view('backoffice.pendaftaran-awal.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tblPendaftaranAwal = (new TblPendaftaranAwal);
        $data = $tblPendaftaranAwal->getDataAll() ?? [];
        if (count($data) > 0) unset($data['last_update']);
        return view('backoffice.pendaftaran-awal.tabel.index', compact('data'));
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
        $menu = 'pendaftaran awal';
        $data = (new TblPendaftaranAwal)->getOneData($id);
        return view('backoffice.pendaftaran-awal.form.edit', compact('data', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tblPendaftaranAwal = (new TblPendaftaranAwal);
        $dataPendaftaranAwal = $tblPendaftaranAwal->getOneData($id);
        $statusPendaftaran = $request->status_pendaftaran_awal;

        $dataPendaftaranAwal['status_pendaftaran_awal'] = $statusPendaftaran;

        $dataUpdate = [
            $id => $dataPendaftaranAwal
        ];

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblPendaftaranAwal->getOneData($dataLastUpdate['key']);
        if ($cek === null) {
            $tblPendaftaranAwal->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblPendaftaranAwal->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $tblPendaftaranAwal->getDatabase()->update($dataUpdate);
        session()->put('daftar_awal', $dataLastUpdate['value']);
        return redirect()->route('pendaftaranAwal.index');
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
        $cek = (new TblPendaftaranAwal)->getDataAll() ?? [];
        if (isset($cek['last_update'])) {
            if (session()->has('daftar_awal')) {
                if (session('daftar_awal') != $cek['last_update']) {
                    session()->put('daftar_awal', $cek['last_update']);
                    return response()->json(true);
                }
            } else {
                session()->put('daftar_awal', $cek['last_update']);
            }
        }
        return response()->json(false);
    }
}
