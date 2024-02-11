<?php

namespace App\Http\Controllers;

use App\Models\Firebase\FirebaseDb;
use App\Models\Firebase\TblOrangTua;
use App\Models\Firebase\TblSiswa;
use App\Models\Firebase\TblUser;
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
            $dataSiswa['foto_siswa'] = $getDataSiswa['foto_siswa'];
            $dataSiswa['kartu_kia_siswa'] = $getDataSiswa['kartu_kia_siswa'];

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

    function pendaftaranSiswa()
    {
        $data = [
            'menu' => 'orang tua',
            'menu_bottom' => 'pendaftaran siswa',
            'pendaftaran_siswa' => (new TblSiswa)->getOneData(session('firebaseUserId')) ?? []
        ];
        return view('frontoffice.pengguna.pendaftaran-siswa', compact('data'));
    }
}
