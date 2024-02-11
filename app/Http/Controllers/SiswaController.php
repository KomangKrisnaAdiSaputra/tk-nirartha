<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblKelas;
use App\Models\Firebase\TblSiswa;
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
        $dataKelas = (new TblKelas)->getDataAllKelas();
        $statusSiswa = (new TblSiswa)->get('status');
        return view('backoffice.siswa.form.edit', compact('menu', 'data', 'dataKelas', 'statusSiswa'));
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
