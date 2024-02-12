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

        return view('backoffice.pembayaran.form.tambah', compact('menu', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tblPembayaran = (new TblBiayaSekolah);
        $field = $tblPembayaran->get('field');
        $dataTahunBulan = Carbon::parse($request->{'bulan&tahun'});
        $id_biaya = Str::uuid()->toString();
        $request->merge(['id_biaya' => $id_biaya]);
        $request->merge(['bulan_biaya' => $dataTahunBulan->format('m')]);
        $request->merge(['tahun_biaya' => $dataTahunBulan->format('Y')]);

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
