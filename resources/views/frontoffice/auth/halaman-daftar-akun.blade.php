@extends('layouts.auth-front')

@section('main')
    <main>
        <!-- Account-Login -->
        <section class="account-sign" style="height: 150vh;">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 ">
                        <div class="account-sign-in">
                            <h5 class="text-center">Daftar Akun</h5>
                            <form action="{{ route('auth.register.register_orang_tua') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Username Akun</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Username akun...." name="username_user" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email Akun</label>
                                    <input type="email" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Email akun...." name="email_user" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password Akun</label>
                                    <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Password akun..." name="password_user" id="password_user"
                                        onchange="validasiPass()" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Konfirmasi Password</label>
                                    <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Ulang password akun..." name="konfirmasi-password"
                                        onchange="validasiPass()" id="konfirmasi_password_user" required>
                                </div>
                                <div class="password-info d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="password-info-left">
                                        <input type="checkbox" id="showpass"
                                            onclick="showPass('password_user', 'konfirmasi_password_user')" class="mb-0">
                                        <input type="hidden" class="mb-0" name="tipe_user" value="3">
                                        <label for="showpass" class="mb-0">Tampil Password</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn bg-primary" id="btn_simpan">Daftar Akun</button>
                                <div class="col mt-4">
                                    <p>Sudah punya akun? <a href="{{ url('secure/auth/login/orangtua') }}">Masuk disini!</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
