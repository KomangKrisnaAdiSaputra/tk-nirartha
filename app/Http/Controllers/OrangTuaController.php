<?php

namespace App\Http\Controllers;

use App\Models\Firebase\FirebaseDb;
use App\Models\Firebase\TblBiayaSekolah;
use App\Models\Firebase\TblOrangTua;
use App\Models\Firebase\TblPendaftaranAwal;
use App\Models\Firebase\TblPendaftaranUlang;
use App\Models\Firebase\TblSiswa;
use App\Models\Firebase\TblUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pengaturan'
        ];

        return view('frontoffice.pengguna.index', compact('data'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $auth = (new FirebaseDb)->getAuth();
        $tbUser = (new TblUser);

        if ($request->type === 'data_akun') {
            $field = $tbUser->get('field');
            $request->merge(['id_user' => $id]);
            $request->merge(['tipe_user' => '3']);
            foreach ($field as $key => $value) {
                $dataUser[$value] = $request->$value;
            }

            $getDataUser = $tbUser->getOneDataUser($id);
            try {
                $auth->changeUserEmail($id, $request->email_user);
                if ($request->password_user != null) {
                    $auth->changeUserPassword($id, $request->password_user);
                    $dataUser['password_user'] = Hash::make($request->password_user);
                } else {
                    $dataUser['password_user'] = $getDataUser['password_user'];
                }

                $dataLastUpdate = [
                    'key' => 'last_update',
                    'value' => Carbon::now()->toDateTimeString()
                ];
                $cek = $tbUser->getDataUsers($dataLastUpdate['key']);
                if ($cek === null) {
                    $tbUser->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
                } else {
                    $tbUser->getDatabase()->update([
                        $dataLastUpdate['key'] => $dataLastUpdate['value']
                    ]);
                }

                $updateUser = [
                    $id => $dataUser
                ];
                $tbUser->getDatabase()->update($updateUser);

                return redirect()->route('orangTua.index');
            } catch (\Throwable $e) {
                switch ($e->getMessage()) {
                    case 'The email address is already in use by another account.':
                        return redirect()->back()->with('error', 'Email sudah digunakan.');
                    case 'A password must be a string with at least 6 characters.':
                        return redirect()->back()->with('error', 'Kata sandi minimal 6 karakter.');
                    default:
                        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
                }
            }
        } elseif ($request->type === 'data_orang_tua') {
            $tblOrangTua = (new TblOrangTua);
            $request->merge(['id_orang_tua' => $id]);
            $request->merge(['id_user' => $id]);
            $fieldOrangTua = $tblOrangTua->get('field');

            foreach ($fieldOrangTua as $key => $value) {
                $dataOrangTua[$value] = $request->$value ?? "";
            }

            $dataLastUpdate = [
                'key' => 'last_update',
                'value' => Carbon::now()->toDateTimeString()
            ];
            $cek = $tblOrangTua->getOneData($dataLastUpdate['key']);
            if ($cek === null) {
                $tblOrangTua->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
            } else {
                $tblOrangTua->getDatabase()->update([
                    $dataLastUpdate['key'] => $dataLastUpdate['value']
                ]);
            }

            $updateOrangTua = [
                $id => $dataOrangTua
            ];

            $tblOrangTua->getDatabase()->update($updateOrangTua);
            return redirect()->route('orangTua.dataOrangTua');
        } elseif ($request->type === 'data_siswa') {
            $tblSiswa = (new TblSiswa);
            $idSiswa = $request->id_siswa ?? Str::uuid()->toString();
            $request->merge(['id_orang_tua' => $id]);
            $request->merge(['id_siswa' => $idSiswa]);
            $fieldSiswa = $tblSiswa->get('field');

            foreach ($fieldSiswa as $key => $value) {
                $dataSiswa[$value] = $request->$value ?? "";
            }

            $getDataSiswa = $tblSiswa->getOneData($idSiswa) ?? [];
            if (count($getDataSiswa) > 0) {
                $dataSiswa['foto_siswa'] = $getDataSiswa['foto_siswa'];
                $dataSiswa['kartu_kia_siswa'] = $getDataSiswa['kartu_kia_siswa'];
            }

            // Foto Siswa
            if ($request->hasFile('foto_siswa') === true) {
                $fotoSiswa = $request->file('foto_siswa');
                $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
                $ekstensi = $fotoSiswa->getClientMimeType();

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    $path = public_path('image/fotoSiswa/');
                    !is_dir($path) &&
                        mkdir($path, 0777, true);

                    if (count($getDataSiswa) > 0) {
                        if ($getDataSiswa['foto_siswa'] != "") {
                            $imagePathFotoSiswa = getcwd() . '/image/fotoSiswa/' . $getDataSiswa['foto_siswa'];
                            if (File::exists($imagePathFotoSiswa)) {
                                File::delete($imagePathFotoSiswa);
                            }
                        }
                    }

                    $foto_siswa = time() . '.' . $fotoSiswa->extension();
                    $fotoSiswa->move($path, $foto_siswa);
                    $dataSiswa['foto_siswa'] = $foto_siswa;
                } else {
                    return redirect()->back()->with('error', 'Upload Foto Siswa Dengan Ekstensi png/jpg/jpeg!');
                }
            } // End Foto Siswa

            // Kartu Kia Siswa
            if ($request->hasFile('kartu_kia_siswa') === true) {
                $kartuKiaSiswa = $request->file('kartu_kia_siswa');
                $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
                $ekstensi = $kartuKiaSiswa->getClientMimeType();

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    $path = public_path('image/fotoKartuSiaSiswa/');
                    !is_dir($path) &&
                        mkdir($path, 0777, true);

                    if (count($getDataSiswa) > 0) {
                        if ($getDataSiswa['kartu_kia_siswa'] != "") {
                            $imagePathKartuKiaSiswa = getcwd() . '/image/fotoKartuSiaSiswa/' . $getDataSiswa['kartu_kia_siswa'];
                            if (File::exists($imagePathKartuKiaSiswa)) {
                                File::delete($imagePathKartuKiaSiswa);
                            }
                        }
                    }

                    $kartu_kia_siswa = time() . '.' . $kartuKiaSiswa->extension();
                    $kartuKiaSiswa->move($path, $kartu_kia_siswa);
                    $dataSiswa['kartu_kia_siswa'] = $kartu_kia_siswa;
                } else {
                    return redirect()->back()->with('error', 'Upload Kartu Sia Siswa Dengan Ekstensi png/jpg/jpeg!');
                }
            } // End Kartu Sia Siswa

            $dataLastUpdate = [
                'key' => 'last_update',
                'value' => Carbon::now()->toDateTimeString()
            ];
            $cek = $tblSiswa->getOneData($dataLastUpdate['key']);
            if ($cek === null) {
                $tblSiswa->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
            } else {
                $tblSiswa->getDatabase()->update([
                    $dataLastUpdate['key'] => $dataLastUpdate['value']
                ]);
            }

            if ($request->data_apa === 'tambah') {
                $tblSiswa->getDatabase(true, $idSiswa)->set($dataSiswa);
            } elseif ($request->data_apa === 'edit') {
                $updateSiswa = [
                    $idSiswa => $dataSiswa
                ];
                $tblSiswa->getDatabase()->update($updateSiswa);
            }
            return redirect()->route('orangTua.dataSiswa');
        } elseif ($request->type === 'pendaftaran_awal') {
            $tblPendaftaranAwal = (new TblPendaftaranAwal);
            $request->merge(['id_pendaftaran_awal' => $this->idPendaftaran('pendaftaran_awal')]);
            $request->merge(['tgl_pendaftaran_awal' => Carbon::now()->toDateString()]);
            $request->merge(['status_pendaftaran_awal' => "0"]);
            $field = $tblPendaftaranAwal->get('field');

            foreach ($field as $key => $value) {
                $dataPendaftaranAwal[$value] = $request->$value ?? '';
            }

            // Bukti Pembayaran
            if ($request->hasFile('bukti_pembayaran_pendaftaran_awal') === true) {
                $buktiPembayaran = $request->file('bukti_pembayaran_pendaftaran_awal');
                $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
                $ekstensi = $buktiPembayaran->getClientMimeType();

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    $path = public_path('image/pendaftaranAwal/');
                    !is_dir($path) &&
                        mkdir($path, 0777, true);

                    $bukti_pembayaran_pendaftaran_awal = time() . '.' . $buktiPembayaran->extension();
                    $buktiPembayaran->move($path, $bukti_pembayaran_pendaftaran_awal);
                    $dataPendaftaranAwal['bukti_pembayaran_pendaftaran_awal'] = $bukti_pembayaran_pendaftaran_awal;
                } else {
                    return redirect()->back()->with('error', 'Upload Kartu Sia Siswa Dengan Ekstensi png/jpg/jpeg!');
                }
            } // End Bukti Pembayaran

            $dataLastUpdate = [
                'key' => 'last_update',
                'value' => Carbon::now()->toDateTimeString()
            ];
            $cek = $tblPendaftaranAwal->getOneData($dataLastUpdate['key']);
            if ($cek === null) {
                $tblPendaftaranAwal->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
            } else {
                $tblPendaftaranAwal->getDatabase()->update([
                    $dataLastUpdate['key'] => $dataLastUpdate['value']
                ]);
            }

            $tblPendaftaranAwal->getDatabase(true, $request->id_siswa)->set($dataPendaftaranAwal);
            return redirect()->route('orangTua.pendaftaranSiswa');
        } elseif ($request->type === 'pendaftaran_ulang') {
            $tblPendaftaranUlang = (new TblPendaftaranUlang);
            $request->merge(['id_pendaftaran_ulang' => $this->idPendaftaran('pendaftaran_ulang')]);
            $request->merge(['tgl_pendaftaran_ulang' => Carbon::now()->toDateString()]);
            $request->merge(['status_pendaftaran_ulang' => "0"]);
            $field = $tblPendaftaranUlang->get('field');

            foreach ($field as $key => $value) {
                $dataPendaftaranUlang[$value] = $request->$value ?? '';
            }

            // Bukti Pembayaran
            if ($request->hasFile('bukti_pembayaran_pendaftaran_ulang') === true) {
                $buktiPembayaran = $request->file('bukti_pembayaran_pendaftaran_ulang');
                $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
                $ekstensi = $buktiPembayaran->getClientMimeType();

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    $path = public_path('image/pendaftaranUlang/');
                    !is_dir($path) &&
                        mkdir($path, 0777, true);

                    $bukti_pembayaran_pendaftaran_ulang = time() . '.' . $buktiPembayaran->extension();
                    $buktiPembayaran->move($path, $bukti_pembayaran_pendaftaran_ulang);
                    $dataPendaftaranUlang['bukti_pembayaran_pendaftaran_ulang'] = $bukti_pembayaran_pendaftaran_ulang;
                } else {
                    return redirect()->back()->with('error', 'Upload Kartu Sia Siswa Dengan Ekstensi png/jpg/jpeg!');
                }
            } // End Bukti Pembayaran

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

            $tblPendaftaranUlang->getDatabase(true, $request->id_siswa)->set($dataPendaftaranUlang);
            return redirect()->route('orangTua.pendaftaranUlangSiswa');
        } elseif ($request->type === 'data_pembayaran') {
            $tblPembayaran = (new TblBiayaSekolah);
            $idPembayaran = $request->id_biaya;
            $dataPembayaran = $tblPembayaran->getOneData($idPembayaran);
            $dataPembayaran['tgl_pembayaran_biaya'] = Carbon::now()->toDateString();
            $dataPembayaran['status_biaya'] = '0';

            // Bukti Pembayaran
            if ($request->hasFile('foto_pembayaran') === true) {
                $buktiPembayaran = $request->file('foto_pembayaran');
                $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
                $ekstensi = $buktiPembayaran->getClientMimeType();

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    $path = public_path('image/fotoPembayaran/');
                    !is_dir($path) &&
                        mkdir($path, 0777, true);

                    if (count($dataPembayaran) > 0) {
                        if ($dataPembayaran['foto_pembayaran'] != "") {
                            $imagePathFotoPembayaran = getcwd() . '/image/fotoPembayaran/' . $dataPembayaran['foto_pembayaran'];
                            if (File::exists($imagePathFotoPembayaran)) {
                                File::delete($imagePathFotoPembayaran);
                            }
                        }
                    }

                    $foto_pembayaran = time() . '.' . $buktiPembayaran->extension();
                    $buktiPembayaran->move($path, $foto_pembayaran);
                    $dataPembayaran['foto_pembayaran'] = $foto_pembayaran;
                } else {
                    return redirect()->back()->with('error', 'Upload Kartu Sia Siswa Dengan Ekstensi png/jpg/jpeg!');
                }
            } // End Bukti Pembayaran


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

            $dataUpdate = [
                $idPembayaran => $dataPembayaran
            ];

            $tblPembayaran->getDatabase()->update($dataUpdate);

            return redirect()->route('orangTua.dataPembayaranSiswa')->with('success', 'Berhasil Edit Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function dataOrangTua()
    {
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'data orang tua',
            'orang_tua' => (new TblOrangTua)->getOneData(session('firebaseUserId'))
        ];

        return view('frontoffice.pengguna.data-orang-tua', compact('data'));
    }

    function dataSiswa()
    {

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'data siswa',
            'siswa' => []
        ];
        return view('frontoffice.pengguna.data_siswa.index', compact('data'));
    }

    function tabelDataSiswa()
    {
        $dataSiswa = (new TblSiswa)->getDataAll() ?? [];
        if (count($dataSiswa) > 0) unset($dataSiswa['last_update']);
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'data siswa',
            'siswa' => array_values(array_filter($dataSiswa, function ($item) {
                return $item['id_orang_tua'] === session('firebaseUserId');
            }))
        ];
        return view('frontoffice.pengguna.data_siswa.tabel.index', compact('data'));
    }

    function tambahDataSiswa()
    {
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'data siswa',
            'siswa' => []
        ];
        return view('frontoffice.pengguna.data_siswa.form.tambah', compact('data'));
    }

    function editDataSiswa($id)
    {
        $dataSiswa = (new TblSiswa)->getDataAll() ?? [];
        if (count($dataSiswa) > 0) unset($dataSiswa['last_update']);
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'data siswa',
            'siswa' => array_values(array_filter($dataSiswa, function ($item) use ($id) {
                return $item['id_siswa'] === $id;
            }))[0]
        ];
        return view('frontoffice.pengguna.data_siswa.form.edit', compact('data'));
    }

    function detailDataSiswa($id)
    {
        $dataSiswa = (new TblSiswa)->getDataAll() ?? [];
        if (count($dataSiswa) > 0) unset($dataSiswa['last_update']);
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'data siswa',
            'siswa' => array_values(array_filter($dataSiswa, function ($item) use ($id) {
                return $item['id_siswa'] === $id;
            }))[0]
        ];
        return view('frontoffice.pengguna.data_siswa.detail.index', compact('data'));
    }

    function pendaftaranAwalSiswa()
    {
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran siswa',
            'pendaftaran_awal' => []
        ];
        return view('frontoffice.pengguna.data_pendaftaran.index', compact('data'));
    }

    function tabelPendaftaranAwalSiswa()
    {
        $tblSiswa = (new TblSiswa);
        $tblPendaftaranAwal = (new TblPendaftaranAwal)->getDataAll() ?? [];

        if (count($tblPendaftaranAwal) > 0) unset($tblPendaftaranAwal['last_update']);

        $dataPendaftaranAwal = array_values(array_filter($tblPendaftaranAwal, function ($item) use ($tblSiswa) {
            $cekData = $tblSiswa->getOneData($item['id_siswa']);
            if ($cekData['id_orang_tua'] === session('firebaseUserId')) {
                return $item;
            }
        }));

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran siswa',
            'pendaftaran_awal' => $dataPendaftaranAwal
        ];
        return view('frontoffice.pengguna.data_pendaftaran.tabel.index', compact('data'));
    }

    function formPendaftaranAwalSiswa()
    {
        $tblSiswa = (new TblSiswa)->getDataAll() ?? [];
        $tblPendaftaranAwal = (new TblPendaftaranAwal);
        if (count($tblSiswa) > 0) unset($tblSiswa['last_update']);
        $dataSiswa = array_values(array_filter($tblSiswa, function ($item) use ($tblPendaftaranAwal) {
            if ($item['id_orang_tua'] === session('firebaseUserId')) {
                $cekData = $tblPendaftaranAwal->getOneData($item['id_siswa']);
                return $cekData === null;
            }
        }));

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran siswa',
            'siswa' => $dataSiswa
        ];

        return view('frontoffice.pengguna.data_pendaftaran.form.tambah', compact('data'));
    }

    function formEditPendaftaranAwalSiswa($id)
    {
        $tblPendaftaranAwal = (new TblPendaftaranAwal);
        $dataDaftarAwal = $tblPendaftaranAwal->getOneData($id);

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran siswa',
            'pendaftaran' => $dataDaftarAwal
        ];

        return view('frontoffice.pengguna.data_pendaftaran.form.edit', compact('data'));
    }

    function updatePendaftaranAwalSiswa(Request $request, $id)
    {
        $tblPendaftaranAwal = (new TblPendaftaranAwal);
        $dataDaftarAwal = $tblPendaftaranAwal->getOneData($id);
        $dataDaftarAwal['status_pendaftaran_awal'] = '0';


        // Bukti Pembayaran
        if ($request->hasFile('bukti_pembayaran_pendaftaran_awal') === true) {
            $buktiPembayaran = $request->file('bukti_pembayaran_pendaftaran_awal');
            $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
            $ekstensi = $buktiPembayaran->getClientMimeType();

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                $path = public_path('image/pendaftaranAwal/');
                !is_dir($path) &&
                    mkdir($path, 0777, true);

                if ($dataDaftarAwal['bukti_pembayaran_pendaftaran_awal'] != "") {
                    $imagePathFotoPembayaran = getcwd() . '/image/pendaftaranAwal/' . $dataDaftarAwal['bukti_pembayaran_pendaftaran_awal'];
                    if (File::exists($imagePathFotoPembayaran)) {
                        File::delete($imagePathFotoPembayaran);
                    }
                }

                $bukti_pembayaran_pendaftaran_awal = time() . '.' . $buktiPembayaran->extension();
                $buktiPembayaran->move($path, $bukti_pembayaran_pendaftaran_awal);
                $dataDaftarAwal['bukti_pembayaran_pendaftaran_awal'] = $bukti_pembayaran_pendaftaran_awal;
            } else {
                return redirect()->back()->with('error', 'Upload Kartu Sia Siswa Dengan Ekstensi png/jpg/jpeg!');
            }
        } // End Bukti Pembayaran

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblPendaftaranAwal->getOneData($dataLastUpdate['key']);
        if ($cek === null) {
            $tblPendaftaranAwal->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblPendaftaranAwal->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        $tblPendaftaranAwal->getDatabase()->update([$id => $dataDaftarAwal]);
        return redirect()->route('orangTua.pendaftaranSiswa');
    }

    function pendaftaranUlangSiswa()
    {
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran ulang siswa',
            'pendaftaran_ulang' => []
        ];
        return view('frontoffice.pengguna.data_pendaftaran_ulang.index', compact('data'));
    }

    function tabelPendaftaranUlangSiswa()
    {
        $tblSiswa = (new TblSiswa);
        $tblPendaftaranUlang = (new TblPendaftaranUlang)->getDataAll() ?? [];

        if (count($tblPendaftaranUlang) > 0) unset($tblPendaftaranUlang['last_update']);

        $dataPendaftaranUlang = array_values(array_filter($tblPendaftaranUlang, function ($item) use ($tblSiswa) {
            $cekData = $tblSiswa->getOneData($item['id_siswa']);
            if ($cekData['id_orang_tua'] === session('firebaseUserId')) {
                return $item;
            }
        }));

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran ulang siswa',
            'pendaftaran_ulang' => $dataPendaftaranUlang
        ];
        return view('frontoffice.pengguna.data_pendaftaran_ulang.tabel.index', compact('data'));
    }

    function formPendaftaranUlangSiswa()
    {
        $tblSiswa = (new TblSiswa)->getDataAll() ?? [];
        $tblPendaftaranAwal = (new TblPendaftaranAwal);
        $tblPendaftaranUlang = (new TblPendaftaranUlang);
        if (count($tblSiswa) > 0) unset($tblSiswa['last_update']);

        $dataSiswa = array_values(array_filter($tblSiswa, function ($item) use ($tblPendaftaranUlang, $tblPendaftaranAwal) {
            if ($item['id_orang_tua'] === session('firebaseUserId')) {
                $daftarAwal = $tblPendaftaranAwal->getOneData($item['id_siswa']);
                if ($daftarAwal != null) {
                    if ($daftarAwal['status_pendaftaran_awal'] === "1") {
                        $cekData = $tblPendaftaranUlang->getOneData($item['id_siswa']);
                        return $cekData === null;
                    }
                }
            }
        }));

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran ulang siswa',
            'siswa' => $dataSiswa
        ];

        return view('frontoffice.pengguna.data_pendaftaran_ulang.form.tambah', compact('data'));
    }

    function formEditPendaftaranUlangSiswa($id)
    {
        $tblPendaftaranUlang = (new TblPendaftaranUlang);
        $dataDaftarUlang = $tblPendaftaranUlang->getOneData($id);

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran ulang siswa',
            'pendaftaran' => $dataDaftarUlang
        ];

        return view('frontoffice.pengguna.data_pendaftaran_ulang.form.edit', compact('data'));
    }

    function updatePendaftaranUlangSiswa(Request $request, $id)
    {
        $tblPendaftaranUlang = (new TblPendaftaranUlang);
        $dataDaftarUlang = $tblPendaftaranUlang->getOneData($id);
        $dataDaftarUlang['status_pendaftaran_ulang'] = '0';


        // Bukti Pembayaran
        if ($request->hasFile('bukti_pembayaran_pendaftaran_ulang') === true) {
            $buktiPembayaran = $request->file('bukti_pembayaran_pendaftaran_ulang');
            $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
            $ekstensi = $buktiPembayaran->getClientMimeType();

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                $path = public_path('image/pendaftaranUlang/');
                !is_dir($path) &&
                    mkdir($path, 0777, true);

                if ($dataDaftarUlang['bukti_pembayaran_pendaftaran_ulang'] != "") {
                    $imagePathFotoPembayaran = getcwd() . '/image/pendaftaranUlang/' . $dataDaftarUlang['bukti_pembayaran_pendaftaran_ulang'];
                    if (File::exists($imagePathFotoPembayaran)) {
                        File::delete($imagePathFotoPembayaran);
                    }
                }

                $bukti_pembayaran_pendaftaran_ulang = time() . '.' . $buktiPembayaran->extension();
                $buktiPembayaran->move($path, $bukti_pembayaran_pendaftaran_ulang);
                $dataDaftarUlang['bukti_pembayaran_pendaftaran_ulang'] = $bukti_pembayaran_pendaftaran_ulang;
            } else {
                return redirect()->back()->with('error', 'Upload Kartu Sia Siswa Dengan Ekstensi png/jpg/jpeg!');
            }
        } // End Bukti Pembayaran

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

        $tblPendaftaranUlang->getDatabase()->update([$id => $dataDaftarUlang]);
        return redirect()->route('orangTua.pendaftaranUlangSiswa');
    }

    function dataPembayaranSiswa()
    {
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pembayaran',
            'pembayaran' => []
        ];
        return view('frontoffice.pengguna.data_pembayaran.index', compact('data'));
    }

    function tabelPembayaranSiswa()
    {
        $id = session('firebaseUserId');
        $dataSiswa = (new TblSiswa)->getDataAll() ?? [];
        if (count($dataSiswa) > 0) unset($dataSiswa['last_update']);

        $dataPembayaran = (new TblBiayaSekolah)->getAllData() ?? [];
        if (count($dataPembayaran) > 0) unset($dataPembayaran['last_update']);

        $siswa = array_values(array_filter($dataSiswa, function ($item) use ($id) {
            return $item['id_orang_tua'] === $id;
        }));

        $id_siswa = array_column($siswa, 'id_siswa');
        $pembayaran = array_values(array_filter($dataPembayaran, function ($item) use ($id_siswa) {
            return in_array($item['id_siswa'], $id_siswa);
        }));

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pembayaran',
            'pembayaran' => $pembayaran
        ];
        return view('frontoffice.pengguna.data_pembayaran.tabel.index', compact('data'));
    }

    function formPembayaranSiswa($id)
    {
        $dataPembayaran = (new TblBiayaSekolah)->getOneData($id);
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pembayaran',
            'pembayaran' => $dataPembayaran
        ];

        return view('frontoffice.pengguna.data_pembayaran.form.edit', compact('data'));
    }

    function idPendaftaran($status)
    {
        if ($status === "pendaftaran_awal") {
            $tb = (new TblPendaftaranAwal)->getDataAll() ?? [];
            $code = "DA";
            $key = "id_pendaftaran_awal";
        } elseif ($status === "pendaftaran_ulang") {
            $tb = (new TblPendaftaranUlang)->getDataAll() ?? [];
            $code = "DU";
            $key = "id_pendaftaran_ulang";
        }
        if (count($tb) > 0) unset($tb['last_update']);

        $year = date('y');
        $month = date('m');
        $prefix = "{$code}-{$year}{$month}-";
        $order = array_values(array_filter($tb, function ($item) use ($prefix, $key) {
            return strpos(strtolower((string) $item[$key]), strtolower($prefix)) !== false;
        }));
        $id_pendaftaran_awal = array_column($order, $key);
        array_multisort($id_pendaftaran_awal, SORT_DESC, $order);
        if ($order) {
            $num = explode('-', $id_pendaftaran_awal[0])[2];
            $num = (int)$num + 1;
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);
            return $prefix . $num;
        } else {
            return ($prefix . '0001');
        }
    }
}
