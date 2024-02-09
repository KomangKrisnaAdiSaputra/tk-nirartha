<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pengumuman';
        $data = (new TblPengumuman)->getDataPengumuman() ?? [];
        return view('backoffice.pengumuman.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'pengumuman';
        return view('backoffice.pengumuman.form.tambah', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tbPengumuman = (new TblPengumuman);
        $request->merge(['id_pengumuman' => Str::uuid()->toString()]);
        $request->merge(['id_pegawai' => Session::get('firebaseUserId')]);
        $request->merge(['status_pengumuman' => 1]);
        $field = $tbPengumuman->get('field');

        foreach ($field as $key => $value) {
            $data[$value] = $request->$value;
        }

        $customKey = $request->id_pengumuman;
        $dataRef = $tbPengumuman->getDatabase(true, $customKey)->getSnapshot();

        if (!$dataRef->exists()) {
            // Jika kunci belum ada, tambahkan data dengan kunci kustom
            $tbPengumuman->getDatabase(true, $customKey)->set($data);
        } else {
            // Jika kunci sudah ada, tambahkan data baru dengan kunci unik
            $tbPengumuman->getDatabase()->push($data);
        }
        return redirect()->route('pengumuman.index');
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
        $menu = 'pengumuman';
        $data = (new TblPengumuman)->getOneDataPengumuman($id);

        return view('backoffice.pengumuman.form.edit', compact('menu', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tbPengumuman = (new TblPengumuman);
        $request->merge(['id_pengumuman' => $id]);
        $request->merge(['id_pegawai' => Session::get('firebaseUserId')]);
        $request->merge(['status_pengumuman' => 1]);
        $field = $tbPengumuman->get('field');

        foreach ($field as $key => $value) {
            $data[$value] = $request->$value;
        }

        $update = [
            $id => $data
        ];

        $tbPengumuman->getDatabase()->update($update);
        return redirect()->route('pengumuman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tbPengumuman = (new TblPengumuman);
        $tbPengumuman->getDatabase(true, $id)->remove();
        return redirect()->back();
    }
}
