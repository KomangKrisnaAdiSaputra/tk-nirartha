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
                            <form action="{{ route('auth.lupa_pass.form_orangtua') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Masukkan Email Anda" name="email" required>
                                </div>
                                <div class="col">
                                    <a href="{{ route('auth.login.login_orang_tua') }}">Kembali</a>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Ubah Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
