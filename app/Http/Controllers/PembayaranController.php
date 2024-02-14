<?php

namespace App\Http\Controllers;

use App\Models\Firebase\TblBiayaSekolah;
use App\Models\Firebase\TblSiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pembayaran';
        $data = (new TblBiayaSekolah)->getAllData() ?? [];
        if (count($data) > 0) unset($data['last_update']);
        return view('backoffice.pembayaran.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'pembayaran';
        $tblSiswa = (new TblSiswa)->getDataAll() ?? [];

        if (count($tblSiswa) > 0) unset($tblSiswa['last_update']);
        $data = array_values(array_filter($tblSiswa, function ($item) {
            return $item['id_kelas'] != "";
        }));

        $status = (new TblBiayaSekolah)->get('status');

        return view('backoffice.pembayaran.form.tambah', compact('menu', 'data', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tblPembayaran = (new TblBiayaSekolah);
        $field = $tblPembayaran->get('field');
        $id_biaya = Str::uuid()->toString();
        $bulan_tahun = explode('-', $request->{'bulan&tahun'});
        $request->merge(['id_biaya' => $id_biaya]);
        $request->merge(['bulan_biaya' => $bulan_tahun[1]]);
        $request->merge(['tahun_biaya' => $bulan_tahun[0]]);

        foreach ($field as $key => $value) {
            $dataPembayaran[$value] = $request->$value;
        }

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblPembayaran->getOneData($dataLastUpdate['key']);
        if ($cek === null) {
            $tblPembayaran->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblPembayaran->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $tblPembayaran->getDatabase(true, $id_biaya)->set($dataPembayaran);
        session()->put('pembayaran', $dataLastUpdate['value']);

        return redirect()->route('pembayaran.index');
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
        $menu = 'pembayaran';
        $data = (new TblBiayaSekolah)->getOneData($id);
        $status = (new TblBiayaSekolah)->get('status');

        return view('backoffice.pembayaran.form.edit', compact('menu', 'data', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tblPembayaran = (new TblBiayaSekolah);
        $field = $tblPembayaran->get('field');
        $bulan_tahun = explode('-', $request->{'bulan&tahun'});
        $request->merge(['id_biaya' => $id]);
        $request->merge(['bulan_biaya' => $bulan_tahun[1]]);
        $request->merge(['tahun_biaya' => $bulan_tahun[0]]);

        foreach ($field as $key => $value) {
            $dataPembayaran[$value] = $request->$value;
        }

        $dataUpdate = [
            $id => $dataPembayaran
        ];

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblPembayaran->getOneData($dataLastUpdate['key']);
        if ($cek === null) {
            $tblPembayaran->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblPembayaran->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $tblPembayaran->getDatabase()->update($dataUpdate);
        session()->put('pembayaran', $dataLastUpdate['value']);

        return redirect()->route('pembayaran.index');
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
        $cek = (new TblBiayaSekolah)->getAllData() ?? [];
        if (isset($cek['last_update'])) {
            if (session()->has('pembayaran')) {
                if (session('pembayaran') != $cek['last_update']) {
                    session()->put('pembayaran', $cek['last_update']);
                    return true;
                }
            } else {
                session()->put('pembayaran', $cek['last_update']);
            }
        }
        return false;
    }
}
