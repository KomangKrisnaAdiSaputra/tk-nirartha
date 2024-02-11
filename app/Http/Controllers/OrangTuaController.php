<?php

namespace App\Http\Controllers;

use App\Models\Firebase\FirebaseDb;
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
            try {
                $auth->changeUserEmail($id, $request->email_user);
                if ($request->password_user != null) {
                    $auth->changeUserPassword($id, $request->password_user);
                    $dataUser['password_user'] = Hash::make($request->password_user);
                } else {
                    unset($dataUser['password_user']);
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
            $request->merge(['id_pendaftaran_awal' => Str::uuid()->toString()]);
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

            $tblPendaftaranAwal->getDatabase(true, $request->id_siswa)->set($dataPendaftaranAwal);
            return redirect()->route('orangTua.pendaftaranSiswa');
        } elseif ($request->type === 'pendaftaran_ulang') {
            $tblPendaftaranUlang = (new TblPendaftaranUlang);
            $request->merge(['id_pendaftaran_ulang' => Str::uuid()->toString()]);
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

            $tblPendaftaranUlang->getDatabase(true, $request->id_siswa)->set($dataPendaftaranUlang);
            return redirect()->route('orangTua.pendaftaranUlangSiswa');
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
        $dataSiswa = (new TblSiswa)->getDataAll() ?? [];
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'data siswa',
            'siswa' => array_values(array_filter($dataSiswa, function ($item) {
                return $item['id_orang_tua'] === session('firebaseUserId');
            }))
        ];
        return view('frontoffice.pengguna.data_siswa.index', compact('data'));
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
        $tblSiswa = (new TblSiswa);
        $tblPendaftaranAwal = (new TblPendaftaranAwal)->getDataAll() ?? [];

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
        return view('frontoffice.pengguna.data_pendaftaran.index', compact('data'));
    }

    function formPendaftaranAwalSiswa()
    {
        $tblSiswa = (new TblSiswa)->getDataAll();
        $tblPendaftaranAwal = (new TblPendaftaranAwal);

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

    function pendaftaranUlangSiswa()
    {
        $tblSiswa = (new TblSiswa);
        $tblPendaftaranUlang = (new TblPendaftaranUlang)->getDataAll() ?? [];

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
        return view('frontoffice.pengguna.data_pendaftaran_ulang.index', compact('data'));
    }

    function formPendaftaranUlangSiswa()
    {
        $tblSiswa = (new TblSiswa)->getDataAll();
        $tblPendaftaranUlang = (new TblPendaftaranUlang);

        $dataSiswa = array_values(array_filter($tblSiswa, function ($item) use ($tblPendaftaranUlang) {
            if ($item['id_orang_tua'] === session('firebaseUserId')) {
                $cekData = $tblPendaftaranUlang->getOneData($item['id_siswa']);
                return $cekData === null;
            }
        }));

        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran ulang siswa',
            'siswa' => $dataSiswa
        ];

        return view('frontoffice.pengguna.data_pendaftaran_ulang.form.tambah', compact('data'));
    }
}
