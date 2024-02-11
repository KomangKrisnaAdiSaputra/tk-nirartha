<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblBiayaSekolah;
use App\Models\Firebase\TblSiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pembayaran';
        $data = (new TblBiayaSekolah)->getAllData() ?? [];
        return view('backoffice.pembayaran.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'pembayaran';
        $tblSiswa = (new TblSiswa);
        $data = array_values(array_filter($tblSiswa->getDataAll(), function ($item) {
            return $item['id_kelas'] != "";
        }));

        return view('backoffice.pembayaran.form.tambah', compact('menu', 'data'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
