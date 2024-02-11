<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblKelas;
use Carbon\Carbon;
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
        if (count($data) > 0) {
            unset($data['last_update']);
        }
        return view('backoffice.kelas.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'kelas';
        $status = (new TblKelas)->get('status');
        return view('backoffice.kelas.form.tambah', compact('menu', 'status'));
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

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblKelas->getDataKelas($dataLastUpdate['key']);
        if ($cek === null) {
            $tblKelas->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblKelas->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }
        $tblKelas->getDatabase(true, $idKelas)->set($dataKelas);
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
        $status = (new TblKelas)->get('status');

        return view('backoffice.kelas.form.edit', compact('menu', 'data', 'status'));
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

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblKelas->getDataKelas($dataLastUpdate['key']);
        if ($cek === null) {
            $tblKelas->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblKelas->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
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

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tbKelas->getDataKelas($dataLastUpdate['key']);
        if ($cek === null) {
            $tbKelas->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tbKelas->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $tbKelas->getDatabase(true, $id)->remove();
        return redirect()->back();
    }
}
