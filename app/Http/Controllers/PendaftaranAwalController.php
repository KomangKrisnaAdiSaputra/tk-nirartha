<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPendaftaranAwal;
use Illuminate\Http\Request;

class PendaftaranAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pendaftaran awal';
        $tblPendaftaranAwal = (new TblPendaftaranAwal);
        $data = $tblPendaftaranAwal->getDataAll();
        return view('backoffice.pendaftaran-awal.index', compact('menu', 'data'));
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

        $tblPendaftaranAwal->getDatabase()->update($dataUpdate);
        return redirect()->route('pendaftaranAwal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
