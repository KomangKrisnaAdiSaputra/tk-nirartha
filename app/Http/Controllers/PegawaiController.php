<?php

namespace App\Http\Controllers;

use App\Models\Firebase\FirebaseDb;
use App\Models\Firebase\TblPegawai;
use App\Models\Firebase\TblUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pegawai';
        $data = (new TblPegawai)->getDataAllPegawai() ?? [];
        return view('backoffice.pegawai.index', compact('data', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'pegawai';
        return view('backoffice.pegawai.form.tambah', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $auth = (new FirebaseDb)->getAuth();
        $tbUser = (new TblUser);
        $tbPegawai = (new TblPegawai);
        $field = $tbUser->get('field');
        $fieldPegawai = $tbPegawai->get('field');

        $request->merge(['tipe_user' => 2]);
        $request->merge(['nama_pegawai' => $request->username_user]);
        $request->merge(['created_at' => Carbon::now()->toDateString()]);
        $request->merge(['updated_at' => Carbon::now()->toDateString()]);
        foreach ($field as $key => $value) {
            $dataUser[$value] = $request->$value;
        }



        foreach ($fieldPegawai as $key => $value) {
            $dataPegawai[$value] = $request->$value;
        }

        try {
            $newUser = $auth->createUserWithEmailAndPassword($dataUser['email_user'], $dataUser['password_user']);

            $customKey = $newUser->uid;
            $dataUser['id_user'] = $customKey;
            $dataUser['password_user'] = Hash::make($dataUser['password_user']);

            $foto = $request->file('foto_pegawai');
            $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
            $ekstensi = $foto->getClientMimeType();

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                $path = public_path('image/fotoPegawai/');
                !is_dir($path) &&
                    mkdir($path, 0777, true);
                $nama_gambar = time() . '.' . $request->gambar->extension();
            } else {
                return redirect()->back()->with('error', 'Upload Foto Dengan Ekstensi png/jpg/jpeg!');
            }

            $dataPegawai['id_pegawai'] = $customKey;
            $dataPegawai['id_user'] = $customKey;
            $dataPegawai['foto'] = $nama_gambar;

            try {
                // Cek apakah kunci sudah ada
                $dataRef = $tbUser->getDatabase(true, $customKey)->getSnapshot();

                if (!$dataRef->exists()) {
                    // Jika kunci belum ada, tambahkan data dengan kunci kustom
                    $tbUser->getDatabase(true, $customKey)->set($dataUser);
                } else {
                    // Jika kunci sudah ada, tambahkan data baru dengan kunci unik
                    $tbUser->getDatabase()->push($dataUser);
                }
                $tbPegawai->getDatabase(true, $customKey)->set($dataPegawai);

                // Data berhasil ditambahkan
                return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan.');
            } catch (\Exception $e) {
                // Tangani kesalahan jika ada
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
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
        $menu = 'pegawai';
        $dataPegawai = (new TblPegawai)->getDataPegawai($id);
        $dataUserPegawai = (new TblUser)->getOneDataUser($id);

        return view('backoffice.pegawai.form.edit', compact('menu', 'dataPegawai', 'dataUserPegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $auth = (new FirebaseDb)->getAuth();
        $newEmail = "admin2@gmail.com";
        $newPassword = "123456";
        // $auth->changeUserEmail($id, $newEmail);
        // $auth->changeUserPassword($id, $newPassword);

        $auth = (new FirebaseDb)->getAuth();
        $tbUser = (new TblUser);
        $tbPegawai = (new TblPegawai);
        $field = $tbUser->get('field');
        $fieldPegawai = $tbPegawai->get('field');

        $request->merge(['tipe_user' => 2]);
        $request->merge(['nama_pegawai' => $request->username_user]);
        $request->merge(['created_at' => Carbon::now()->toDateString()]);
        $request->merge(['updated_at' => Carbon::now()->toDateString()]);
        foreach ($field as $key => $value) {
            $dataUser[$value] = $request->$value;
        }



        foreach ($fieldPegawai as $key => $value) {
            $dataPegawai[$value] = $request->$value;
        }

        try {
            $newUser = $auth->createUserWithEmailAndPassword($dataUser['email_user'], $dataUser['password_user']);

            $customKey = $newUser->uid;
            $dataUser['id_user'] = $customKey;
            $dataUser['password_user'] = Hash::make($dataUser['password_user']);

            $dataPegawai['id_pegawai'] = $customKey;
            $dataPegawai['id_user'] = $customKey;
            $dataPegawai['foto'] = "";

            try {
                // Cek apakah kunci sudah ada
                $dataRef = $tbUser->getDatabase(true, $customKey)->getSnapshot();

                if (!$dataRef->exists()) {
                    // Jika kunci belum ada, tambahkan data dengan kunci kustom
                    $tbUser->getDatabase(true, $customKey)->set($dataUser);
                } else {
                    // Jika kunci sudah ada, tambahkan data baru dengan kunci unik
                    $tbUser->getDatabase()->push($dataUser);
                }
                $tbPegawai->getDatabase(true, $customKey)->set($dataPegawai);

                // Data berhasil ditambahkan
                return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan.');
            } catch (\Exception $e) {
                // Tangani kesalahan jika ada
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
