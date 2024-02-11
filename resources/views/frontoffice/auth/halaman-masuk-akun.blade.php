@extends('layouts.auth-front')

@section('main')
    <main>
        <!-- Account-Login -->
        <section class="account-sign" style="height: 100vh;">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 ">
                        <div class="account-sign-in">
                            <h5 class="text-center">Akun</h5>
                            <form action="{{ route('auth.login.login_orang_tua') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Email akun..." name="email" value="" required>
                                    <div class="invalid-feedback">
                                        error
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Password akun..." name="password" value="" required>
                                    <div class="invalid-feedback">
                                        error
                                    </div>
                                </div>
                                <div class="password-info d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="password-info-left">
                                        <input type="checkbox" id="showpass" class="mb-0">
                                        <label for="showpass" class="mb-0">Tampil Password</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Masuk Akun
                                </button>
                                <div class="col mt-4">
                                    <p>Belum punya akun? <a href="{{ url('secure/auth/register/orangtua') }}">Daftar
                                            disini!</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
