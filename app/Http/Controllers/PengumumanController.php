<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblPengumuman;
use Carbon\Carbon;
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
        if (count($data) > 0) {
            unset($data['last_update']);
        }
        return view('backoffice.pengumuman.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'pengumuman';
        $status = (new TblPengumuman)->get('status');
        return view('backoffice.pengumuman.form.tambah', compact('menu', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tbPengumuman = (new TblPengumuman);
        $request->merge(['id_pengumuman' => Str::uuid()->toString()]);
        $request->merge(['id_pegawai' => Session::get('firebaseUserId')]);
        $field = $tbPengumuman->get('field');

        foreach ($field as $key => $value) {
            $data[$value] = $request->$value;
        }

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tbPengumuman->getDataPengumuman($dataLastUpdate['key']);
        if ($cek === null) {
            $tbPengumuman->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tbPengumuman->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $customKey = $request->id_pengumuman;
        $tbPengumuman->getDatabase(true, $customKey)->set($data);
        session()->put('pengumuman', $dataLastUpdate['value']);

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
        $status = (new TblPengumuman)->get('status');

        return view('backoffice.pengumuman.form.edit', compact('menu', 'data', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tbPengumuman = (new TblPengumuman);
        $request->merge(['id_pengumuman' => $id]);
        $request->merge(['id_pegawai' => Session::get('firebaseUserId')]);
        $request->merge(['status_pengumuman' => $request->status_pengumuman]);
        $field = $tbPengumuman->get('field');

        foreach ($field as $key => $value) {
            $data[$value] = $request->$value;
        }

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tbPengumuman->getDataPengumuman($dataLastUpdate['key']);
        if ($cek === null) {
            $tbPengumuman->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tbPengumuman->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $update = [
            $id => $data
        ];

        $tbPengumuman->getDatabase()->update($update);
        session()->put('pengumuman', $dataLastUpdate['value']);

        return redirect()->route('pengumuman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tbPengumuman = (new TblPengumuman);

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tbPengumuman->getDataPengumuman($dataLastUpdate['key']);
        if ($cek === null) {
            $tbPengumuman->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tbPengumuman->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $tbPengumuman->getDatabase(true, $id)->remove();
        session()->put('pengumuman', $dataLastUpdate['value']);

        return redirect()->back();
    }

    function cek()
    {
        $cek = (new TblPengumuman)->getDataPengumuman() ?? [];
        if (isset($cek['last_update'])) {
            if (session()->has('pengumuman')) {
                if (session('pengumuman') != $cek['last_update']) {
                    session()->put('pengumuman', $cek['last_update']);
                    return response()->json(true);
                }
            } else {
                session()->put('pengumuman', $cek['last_update']);
            }
        }
        return response()->json(false);
    }
}
