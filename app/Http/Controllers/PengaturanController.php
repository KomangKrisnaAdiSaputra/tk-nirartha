<?php

namespace App\Http\Controllers;

use App\Models\Firebase\FirebaseDb;
use App\Models\Firebase\TblPegawai;
use App\Models\Firebase\TblUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'pengaturan';
        $jenis_kelamin = (new TblPegawai)->get('jk');
        return view('backoffice.pengaturan.index', compact('menu', 'jenis_kelamin'));
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
        $tblUser = (new TblUser);
        $tblPegawai = (new TblPegawai);

        $fieldUser = $tblUser->get('field');
        $fieldPegawai = $tblPegawai->get('field');

        $dataLogin = $tblUser->getOneDataUser($id);

        $request->merge(['id_user' => $id]);
        $request->merge(['tipe_user' => (string) $dataLogin['tipe_user']]);

        foreach ($fieldUser as $key => $value) {
            $dataUser[$value] = $request->$value;
        }

        if ((string) $dataLogin['tipe_user'] === "2") {
            $getDataPegawai = $tblPegawai->getDataPegawai($id);
            $request->merge(['id_pegawai' => $id]);
            $request->merge(['nama_pegawai' => $request->username_user]);
            foreach ($fieldPegawai as $key => $value) {
                $dataPegawai[$value] = $request->$value;
            }

            $nama_gambar = $getDataPegawai['foto_pegawai'];

            if ($request->hasFile('foto_pegawai') === true) {
                $foto = $request->file('foto_pegawai');
                $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
                $ekstensi = $foto->getClientMimeType();

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    $path = public_path('image/fotoPegawai/');
                    !is_dir($path) &&
                        mkdir($path, 0777, true);


                    $imagePath = getcwd() . '/image/fotoPegawai/' . $getDataPegawai['foto_pegawai'];
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }

                    $nama_gambar = time() . '.' . $foto->extension();
                    $foto->move($path, $nama_gambar);
                } else {
                    return redirect()->back()->with('error', 'Upload Foto Dengan Ekstensi png/jpg/jpeg!');
                }
            }
            $dataPegawai['foto_pegawai'] = $nama_gambar;
            $dataPegawai['created_at'] = $getDataPegawai['created_at'];
            $dataPegawai['updated_at'] = Carbon::now()->toDateString();
        }

        $dataLastUpdate = [
            'key' => 'last_update',
            'value' => Carbon::now()->toDateTimeString()
        ];
        $cek = $tblUser->getDataUsers($dataLastUpdate['key']);
        if ($cek === null) {
            $tblUser->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblUser->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }
        $cek2 = $tblPegawai->getDataAllPegawai($dataLastUpdate['key']);
        if ($cek2 === null) {
            $tblPegawai->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
        } else {
            $tblPegawai->getDatabase()->update([
                $dataLastUpdate['key'] => $dataLastUpdate['value']
            ]);
        }

        try {
            $auth->changeUserEmail($id, $request->email_user);
            if ($request->password_user != null) {
                $auth->changeUserPassword($id, $request->password_user);
                $dataUser['password_user'] = Hash::make($request->password_user);
            } else {
                $dataUser['password_user'] = $dataLogin['password_user'];
            }


            $updateUser = [
                $id => $dataUser
            ];
            $tblUser->getDatabase()->update($updateUser);

            if ((string) $dataLogin['tipe_user'] === "2") {
                $updatePegawai = [
                    $id => $dataPegawai
                ];
                $tblPegawai->getDatabase()->update($updatePegawai);
            }

            return redirect()->route('pengaturan.index')->with('success', 'Data Berhasil Di Simpan!');
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
