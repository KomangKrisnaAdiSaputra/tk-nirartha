<?php

namespace App\Http\Controllers;

use App\Models\Firebase\FirebaseDb;
use App\Models\Firebase\TblPegawai;
use App\Models\Firebase\TblUser;
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
        $field = $tbUser->get('field');

        foreach ($field as $key => $value) {
            $data[$value] = $request->$value;
        }

        try {
            $newUser = $auth->createUserWithEmailAndPassword($data['email_user'], $data['password_user']);

            $customKey = $newUser->uid;
            $data['id_user'] = $customKey;
            $data['password_user'] = Hash::make($data['password_user']);

            try {
                // Cek apakah kunci sudah ada
                $dataRef = $tbUser->getDatabase(true, $customKey)->getSnapshot();

                if (!$dataRef->exists()) {
                    // Jika kunci belum ada, tambahkan data dengan kunci kustom
                    $tbUser->getDatabase(true, $customKey)->set($data);
                } else {
                    // Jika kunci sudah ada, tambahkan data baru dengan kunci unik
                    $tbUser->getDatabase()->push($data);
                }

                // Data berhasil ditambahkan
                return redirect()->route('auth.login.form_login_orang_tua')->with('success', 'Data berhasil ditambahkan.');
            } catch (\Exception $e) {
                // Tangani kesalahan jika ada
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'The email address is already in use by another account.':
                    return redirect()->back()->with('error', 'Email sudah digunakan.');
                    break;
                case 'A password must be a string with at least 6 characters.':
                    return redirect()->back()->with('error', 'Kata sandi minimal 6 karakter.');
                    break;
                default:
                    return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
                    break;
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
