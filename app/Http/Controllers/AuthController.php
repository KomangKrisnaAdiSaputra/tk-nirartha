<?php


namespace App\Http\Controllers;

use App\Mail\SendMailForgotPass;
use App\Models\Firebase\FirebaseDb;
use App\Models\Firebase\TblOrangTua;
use App\Models\Firebase\TblUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Factory;

class AuthController extends Controller
{

    private $auth;
    private $database;
    private $tbUser;

    public function __construct(Database $database)
    {
        $this->auth = (new FirebaseDb)->getAuth();
        $this->tbUser = (new TblUser);
    }

    // Section Admin, Kepala Sekolah, Guru
    public function form_login_pegawai()
    {
        return view('backoffice.auth.halaman-masuk-akun');
    }
    public function login_pegawai(Request $request)
    {
        $email = $request->email;
        $pass = $request->password;

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $pass);
            Session::put('firebaseUserId', $signInResult->firebaseUserId());
            Session::put('idToken', $signInResult->idToken());
            Session::save();
            return redirect()->route('dashboard.dashboard_index')->with('success', 'Login Berhasil');
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'INVALID_PASSWORD':
                    return redirect()->back()->with('error', 'Kata sandi salah!.');
                    break;
                case 'EMAIL_NOT_FOUND':
                    return redirect()->back()->with('error', 'Email tidak ditemukan.');
                    break;
                default:
                    return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
                    break;
            }
        }
    }
    function logout_pegawai()
    {
        if (Session::has('firebaseUserId') && Session::has('idToken')) {
            $this->auth->revokeRefreshTokens(Session::get('firebaseUserId'));
            Session::forget('firebaseUserId');
            Session::forget('idToken');
            Session::save();
            return redirect()->route('auth.login.form_login_pegawai')->with('success', 'Logout Berhasil');
        } else {
            return redirect()->back()->with('error', 'Anda Belum Login');
        }
    }

    // Section Orang Tua
    public function form_register_orang_tua()
    {
        return view('frontoffice.auth.halaman-daftar-akun');
    }

    public function register_orang_tua(Request $request)
    {
        $tblOrangTua = (new TblOrangTua);
        $field = $this->tbUser->get('field');
        $fieldOrangTua = $tblOrangTua->get('field');

        foreach ($field as $key => $value) {
            $data[$value] = $request->$value;
        }
        foreach ($fieldOrangTua as $key => $value) {
            $dataOrangTua[$value] = $request->$value ?? "";
        }

        try {
            $newUser = $this->auth->createUserWithEmailAndPassword($data['email_user'], $data['password_user']);

            $customKey = $newUser->uid;
            $data['id_user'] = $customKey;
            $data['password_user'] = Hash::make($data['password_user']);

            $dataOrangTua['id_orang_tua'] = $customKey;
            $dataOrangTua['id_user'] = $customKey;

            try {

                $dataLastUpdate = [
                    'key' => 'last_update',
                    'value' => Carbon::now()->toDateTimeString()
                ];
                $cek = $this->tbUser->getOneDataUser($dataLastUpdate['key']);
                if ($cek === null) {
                    $this->tbUser->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
                } else {
                    $this->tbUser->getDatabase()->update([
                        $dataLastUpdate['key'] => $dataLastUpdate['value']
                    ]);
                }

                $cek2 = $tblOrangTua->getOneData($dataLastUpdate['key']);
                if ($cek2 === null) {
                    $tblOrangTua->getDatabase(true, $dataLastUpdate['key'])->set($dataLastUpdate['value']);
                } else {
                    $tblOrangTua->getDatabase()->update([
                        $dataLastUpdate['key'] => $dataLastUpdate['value']
                    ]);
                }

                $this->tbUser->getDatabase(true, $customKey)->set($data);

                $tblOrangTua->getDatabase(true, $customKey)->set($dataOrangTua);

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

    public function form_login_orang_tua()
    {
        return view('frontoffice.auth.halaman-masuk-akun');
    }
    public function login_orang_tua(Request $request)
    {
        $email = $request->email;
        $pass = $request->password;

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $pass);
            Session::put('firebaseUserId', $signInResult->firebaseUserId());
            Session::put('idToken', $signInResult->idToken());
            Session::save();
            return redirect()->route('orangTua.index')->with('success', 'Login Berhasil');
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'INVALID_PASSWORD':
                    return redirect()->back()->with('error', 'Kata sandi salah!.');
                    break;
                case 'EMAIL_NOT_FOUND':
                    return redirect()->back()->with('error', 'Email tidak ditemukan.');
                    break;
                default:
                    return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
                    break;
            }
        }
    }

    function logout_orang_tua()
    {
        if (Session::has('firebaseUserId') && Session::has('idToken')) {
            $this->auth->revokeRefreshTokens(Session::get('firebaseUserId'));
            Session::forget('firebaseUserId');
            Session::forget('idToken');
            Session::save();
            return redirect()->route('auth.login.form_login_orang_tua')->with('success', 'Logout Berhasil');
        } else {
            return redirect()->back()->with('error', 'Anda Belum Login');
        }
    }


    function lupa_pass_orangtua(Request $request)
    {
        $tblOrangTua = (new TblUser);
        $email = $request->email;

        $dataOrangTua = $tblOrangTua->getDataUsers();
        if (count($dataOrangTua) > 0) unset($dataOrangTua['last_update']);
        $cekData =  array_values(array_filter($dataOrangTua, function ($item) use ($email) {
            return (string) $item['email_user'] === $email;
        }));

        if (count($cekData) <= 0) return redirect()->back()->with('error', 'Email Tidak Ditemukan!');

        $idUser = $cekData[0]['id_user'];
        $nameUser = $cekData[0]['username_user'];
        $emailUser = $cekData[0]['email_user'];
        $auth = (new FirebaseDb)->getAuth();
        $newRandPass = Str::random(6);
        $auth->changeUserPassword($idUser, $newRandPass);
        $dataUser = (object) [
            'name' => $nameUser,
            'new_pass' => $newRandPass,
            'link_login' => route('auth.login.login_orang_tua')
        ];
        Mail::to($emailUser)->send(new SendMailForgotPass($dataUser));
        return redirect()->route('auth.login.login_orang_tua')->with('success', 'Lihat Email Untuk Password Baru!');
    }

    function lupa_pass_pegawai(Request $request)
    {
        $tblPegawai = (new TblUser);
        $email = $request->email;

        $dataPegawai = $tblPegawai->getDataUsers();
        if (count($dataPegawai) > 0) unset($dataPegawai['last_update']);
        $cekData =  array_values(array_filter($dataPegawai, function ($item) use ($email) {
            return (string) $item['email_user'] === $email;
        }));

        if (count($cekData) <= 0) return redirect()->back()->with('error', 'Email Tidak Ditemukan!');

        $idUser = $cekData[0]['id_user'];
        $nameUser = $cekData[0]['username_user'];
        $emailUser = $cekData[0]['email_user'];
        $auth = (new FirebaseDb)->getAuth();
        $newRandPass = Str::random(6);
        $auth->changeUserPassword($idUser, $newRandPass);
        $dataUser = (object) [
            'name' => $nameUser,
            'new_pass' => $newRandPass,
            'link_login' => route('auth.login.login_pegawai')
        ];
        Mail::to($emailUser)->send(new SendMailForgotPass($dataUser));
        return redirect()->route('auth.login.login_pegawai')->with('success', 'Lihat Email Untuk Password Baru!');
    }
}
