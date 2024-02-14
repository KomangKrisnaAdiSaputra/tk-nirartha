<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPendaftaranUlang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendaftaranUlangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pendaftaran ulang';
        $tblPendaftaranUlang = (new TblPendaftaranUlang);
        $data = $tblPendaftaranUlang->getDataAll() ?? [];

        if (count($data) > 0) unset($data['last_update']);
        return view('backoffice.pendaftaran-ulang.index', compact('menu', 'data'));
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
        $menu = 'pendaftaran ulang';
        $data = (new TblPendaftaranUlang)->getOneData($id);
        return view('backoffice.pendaftaran-ulang.form.edit', compact('data', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tblPendaftaranUlang = (new TblPendaftaranUlang);
        $dataPendaftaranUlang = $tblPendaftaranUlang->getOneData($id);
        $statusPendaftaran = $request->status_pendaftaran_ulang;

        $dataPendaftaranUlang['status_pendaftaran_ulang'] = $statusPendaftaran;

        $dataUpdate = [
            $id => $dataPendaftaranUlang
        ];

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblPendaftaranUlang->getOneData($dataLastUpdate['key']);
        if ($cek === null) {
            $tblPendaftaranUlang->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblPendaftaranUlang->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $tblPendaftaranUlang->getDatabase()->update($dataUpdate);
        session()->put('daftar_ulang', $dataLastUpdate['value']);
        return redirect()->route('pendaftaranUlang.index');
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
        $cek = (new TblPendaftaranUlang)->getDataAll() ?? [];
        if (isset($cek['last_update'])) {
            if (session()->has('daftar_ulang')) {
                if (session('daftar_ulang') != $cek['last_update']) {
                    session()->put('daftar_ulang', $cek['last_update']);
                    return true;
                }
            } else {
                session()->put('daftar_ulang', $cek['last_update']);
            }
        }
        return false;
    }
}
