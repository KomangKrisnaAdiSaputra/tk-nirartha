<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranAwalController;
use App\Http\Controllers\PendaftaranUlangController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaController;
use App\Models\Firebase\TblPendaftaranAwal;
use App\Models\Firebase\TblPendaftaranUlang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::post('/landing', 'LandingController@index')->name('landing');
// Route::get('/landing', function () {
//     return view('frontoffice.index');
// });

Route::prefix('secure/auth/')->name('auth.')->group(function () {
    // REGISTER
    Route::prefix('register/')->name('register.')->group(function () {
        Route::get('/orangtua', [AuthController::class, 'form_register_orang_tua'])->name('form_register_orang_tua');
        Route::post('/orangtua', [AuthController::class, 'register_orang_tua'])->name('register_orang_tua');
    });

    // LOGIN
    Route::prefix('login/')->name('login.')->group(function () {
        Route::get('/pegawai', [AuthController::class, 'form_login_pegawai'])->name('form_login_pegawai');
        Route::post('/pegawai', [AuthController::class, 'login_pegawai'])->name('login_pegawai');
        Route::get('/orangtua', [AuthController::class, 'form_login_orang_tua'])->name('form_login_orang_tua');
        Route::post('/orangtua', [AuthController::class, 'login_orang_tua'])->name('login_orang_tua');
    });
});

// Dashboard Pengguna Back
Route::group(['middleware' => ['checkauth:0,2']], function () {
    Route::get('cek-pendaftaran-awal', [PendaftaranAwalController::class, 'cek'])->name('cek_pendaftaran_awal');
    Route::resource('pendaftaran-awal', PendaftaranAwalController::class, ['names' => 'pendaftaranAwal']);

    Route::get('cek-pendaftaran-ulang', [PendaftaranUlangController::class, 'cek'])->name('cek_pendaftaran_ulang');
    Route::resource('pendaftaran-ulang', PendaftaranUlangController::class, ['names' => 'pendaftaranUlang']);

    Route::get('cek-pembayaran', [PembayaranController::class, 'cek'])->name('cek_pembayaran');
    Route::resource('pembayaran', PembayaranController::class, ['names' => 'pembayaran']);

    Route::get('cek-siswa', [SiswaController::class, 'cek'])->name('cek_siswa');
    Route::resource('siswa', SiswaController::class, ['names' => 'siswa']);


    Route::get('cek-pegawai', [PegawaiController::class, 'cekPegawai'])->name('cek_pegawai');
    Route::resource('data-pegawai', PegawaiController::class, ['names' => 'pegawai']);

    Route::resource('pengaturan', PengaturanController::class, ['names' => 'pengaturan']);
});
Route::group(['middleware' => ['checkauth:0,1,2']], function () {
    Route::prefix('dashboard/')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard_index');
        Route::get('/get-data-dashboard', [DashboardController::class, 'getDataDashboard'])->name('get_data_dashboard');
        Route::get('/daftar-ulang', [DashboardController::class, 'dataDaftarUlang'])->name('daftar_ulang');
        Route::get('/data-user', [DashboardController::class, 'dataUser'])->name('data_user');
        Route::get('/logout-pegawai', [AuthController::class, 'logout_pegawai'])->name('logout_pegawai');
        Route::get('/kepala-sekolah', [DashboardController::class, 'tampil_data_kepala_sekolah'])->name('tampil_kepala_sekolah');
        Route::get('/kepala-sekolah/tambah', [DashboardController::class, 'tambah_data_kepala_sekolah'])->name('tambah_kepala_sekolah');
    });

    Route::get('get-data-pendaftaran-ulang', function () {
        $tb = (new TblPendaftaranUlang)->getDataAll() ?? [];
        if (count($tb) > 0) unset($tb['last_update']);
        $data['data'] = $tb;
        $pdf = Pdf::loadView('backoffice.pdf.daftar_ulang', $data);
        return $pdf->stream();
    })->name('getDataPendaftaranUlang');
});
Route::group(['middleware' => ['checkauth:2']], function () {
    Route::get('cek-pengumuman', [PengumumanController::class, 'cek'])->name('cek_pengumuman');
    Route::resource('pengumuman', PengumumanController::class, ['names' => 'pengumuman']);
    Route::resource('kelas', KelasController::class, ['names' => 'kelas']);
});

Route::group(['middleware' => ['checkauth:3']], function () {
    Route::get('orang-tua/data', [OrangTuaController::class, 'dataOrangTua'])->name('orangTua.dataOrangTua');
    Route::get('orang-tua/data-siswa', [OrangTuaController::class, 'dataSiswa'])->name('orangTua.dataSiswa');

    Route::get('orang-tua/tambah-data-siswa', [OrangTuaController::class, 'tambahDataSiswa'])->name('orangTua.tambahDataSiswa');
    Route::get('orang-tua/edit-data-siswa/{id}', [OrangTuaController::class, 'editDataSiswa'])->name('orangTua.editDataSiswa');
    Route::get('orang-tua/detail-data-siswa/{id}', [OrangTuaController::class, 'detailDataSiswa'])->name('orangTua.detailDataSiswa');

    Route::get('orang-tua/pendaftaran-awal-siswa', [OrangTuaController::class, 'pendaftaranAwalSiswa'])->name('orangTua.pendaftaranSiswa');
    Route::get('orang-tua/from-pendaftaran-awal-siswa', [OrangTuaController::class, 'formPendaftaranAwalSiswa'])->name('orangTua.formPendaftaranSiswa');

    Route::get('orang-tua/pendaftaran-ulang-siswa', [OrangTuaController::class, 'pendaftaranUlangSiswa'])->name('orangTua.pendaftaranUlangSiswa');
    Route::get('orang-tua/from-pendaftaran-ulang-siswa', [OrangTuaController::class, 'formPendaftaranUlangSiswa'])->name('orangTua.formPendaftaranUlangSiswa');

    Route::get('orang-tua/form-pembayaran-siswa/{id}', [OrangTuaController::class, 'formPembayaranSiswa'])->name('orangTua.formPembayaranSiswa');
    Route::get('orang-tua/data-pembayaran-siswa', [OrangTuaController::class, 'dataPembayaranSiswa'])->name('orangTua.dataPembayaranSiswa');

    Route::get('/logout-orang-tua', [AuthController::class, 'logout_orang_tua'])->name('logout_orang_tua');

    Route::resource('orang-tua', OrangTuaController::class, ['names' => 'orangTua']);
});

// Landing
Route::get('/', [LandingController::class, 'index'])->name('/');
Route::prefix('landing/')->name('landing.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('/');
    Route::get('/profil', [LandingController::class, 'profil'])->name('landing_profil');
    Route::get('/galeri', [LandingController::class, 'galeri'])->name('landing_galeri');
    Route::get('/pengumuman', [LandingController::class, 'pengumuman'])->name('landing_pengumuman');
    Route::get('/kegiatan', [LandingController::class, 'kegiatan'])->name('landing_kegiatan');
    Route::get('/kontak', [LandingController::class, 'kontak'])->name('landing_kontak');
});
