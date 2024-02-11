<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'kelas';
        $data = (new TblKelas)->getDataAllKelas() ?? [];
        return view('backoffice.kelas.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'kelas';
        return view('backoffice.kelas.form.tambah', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tblKelas = (new TblKelas);
        $field = $tblKelas->get('field');
        $idKelas = Str::uuid()->toString();
        $request->merge(['id_pegawai' => session('firebaseUserId')]);
        $request->merge(['id_kelas' => $idKelas]);

        foreach ($field as $key => $value) {
            $dataKelas[$value] = $request->$value;
        }

        $dataRef = $tblKelas->getDatabase(true, $idKelas)->getSnapshot();

        if (!$dataRef->exists()) {
            // Jika kunci belum ada, tambahkan data dengan kunci kustom
            $tblKelas->getDatabase(true, $idKelas)->set($dataKelas);
        } else {
            // Jika kunci sudah ada, tambahkan data baru dengan kunci unik
            $tblKelas->getDatabase()->push($dataKelas);
        }
        return redirect()->route('kelas.index');
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
        $menu = 'kelas';
        $data = (new TblKelas)->getDataKelas($id);

        return view('backoffice.kelas.form.edit', compact('menu', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tblKelas = (new TblKelas);
        $field = $tblKelas->get('field');
        $request->merge(['id_pegawai' => session('firebaseUserId')]);
        $request->merge(['id_kelas' => $id]);

        foreach ($field as $key => $value) {
            $data[$value] = $request->$value;
        }

        $update = [
            $id => $data
        ];

        $tblKelas->getDatabase()->update($update);
        return redirect()->route('kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tbKelas = (new TblKelas);
        $tbKelas->getDatabase(true, $id)->remove();
        return redirect()->back();
    }
}
