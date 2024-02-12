@extends('layouts.pengguna-front')
@section('data')
    <div class="col-lg-6 col-md-12 mx-auto">
        <div class="account-setting">
            <h6>Data Akun</h6>
            <form action="{{ route('orangTua.update', session('firebaseUserId')) }}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <input type="hidden" name="type" value="data_akun">
                    <label for="">Username User</label>
                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                        placeholder="Username akun..." name="username_user"
                        value="{{ getDataUser(session('firebaseUserId'))['username_user'] }}" required>
                </div>
                <div class="form-group">
                    <label for="">Email User</label>
                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                        placeholder="Email akun..." name="email_user"
                        value="{{ getDataUser(session('firebaseUserId'))['email_user'] }}" required>
                </div>
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control form-control-user form-control-lg fs-6"
                        placeholder="Password baru..." name="password_user" id="password_user" onchange="validasiPass()">
                </div>
                <div class="form-group">
                    <label for="">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control form-control-user form-control-lg fs-6"
                        placeholder="Konfirmasi Password baru..." name="konfirmasi_password_user"
                        id="konfirmasi_password_user" onchange="validasiPass()">
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn bg-outline-secondary-modif" style="border: 2px solid #6c757d;"
                        id="btn_simpan">Edit
                        Data
                        Akun</button>
                </div>
            </form>
        </div>
    </div>
@endsection
