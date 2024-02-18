<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TK Nirata II - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('front/dist/main.css') }}">
    <link rel="stylesheet" href="{{ asset('front/dist/style-custom.css') }}">
    <link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Header Area Start -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="header-top-wrapper">
                            <div class="header-top-info">
                                <div class="email">
                                    <div class="icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <span>tknirata02@gmail.com</span>
                                    </div>
                                </div>
                                <div class="cta">
                                    <div class="icon">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div class="text">
                                        <span>+62-895-394086579</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <!-- Default Menu -->
                <div class="d-none d-lg-block">
                    <nav class="menu-area d-flex align-items-center">
                        <div class="logo">
                            <a href="{{ route('/') }}">
                                <h2>TK Nirata II</h2>
                            </a>
                        </div>
                        <ul class="main-menu d-flex align-items-center">
                            <li><a href="{{ route('landing./') }}">Beranda</a></li>
                            <li><a href="{{ route('landing.landing_profil') }}">Profil</a></li>
                            {{-- <li><a href="../galeri.html">Galeri</a></li> --}}
                            <li><a href="{{ route('landing.landing_pengumuman') }}">Pengumuman</a></li>
                            <li><a href="{{ route('landing.landing_kegiatan') }}">Kegiatan</a>
                            </li>
                            <li><a href="{{ route('landing.landing_kontak') }}">Kontak</a></li>
                        </ul>
                        <div class="col align-items-center">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                @if (session()->has('firebaseUserId') && session()->has('idToken'))
                                    <a class="btn">{{ getDataUser(session('firebaseUserId'))['username_user'] }}</a>
                                    <img class="img-profile rounded-circle" style="width: 10%;"
                                        src="{{ asset('back/img/undraw_profile.svg') }}">
                                @else
                                    <a class="btn btn-link me-md-2"
                                        href="{{ route('auth.login.form_login_orang_tua') }}">Masuk</a>
                                    <a class="btn bg-primary"
                                        href="{{ route('auth.register.form_register_orang_tua') }}">Pendaftaran</a>
                                @endif
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- Mobile Menu -->
                <aside class="d-lg-none">
                    <div id="mySidenav" class="sidenav">
                        <div class="close-mobile-menu">
                            <a href="javascript:void(0)" id="menu-close" class="closebtn"
                                onclick="closeNav()">&times;</a>
                        </div>
                        <li><a href="index.html">Beranda</a></li>
                        <li><a href="profil.html">Profil</a></li>
                        {{-- <li><a href="galeri.html">Galeri</a></li> --}}
                        <li><a href="pengumuman.html">Pengumuman</a></li>
                        <li><a href="kegiatan.html">Kegiatan</a></li>
                        <li><a href="kontak.html">Kontak</a></li>
                        <div class="d-grid text-center">
                            <a class="btn btn-link me-md-2" href="#">Masuk</a>
                            <a class="btn bg-primary" href="#">Pendaftaran</a>
                        </div>
                    </div>
                    <div class="mobile-nav d-flex align-items-center justify-content-between">
                        <div class="logo">
                            <a href="#">
                                <h2>TK Nirata II</h2>
                            </a>
                        </div>
                        <div class="hamburger-menu">
                            <a style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</a>
                        </div>
                    </div>
                </aside>
                <!-- Body overlay -->
                <div class="overlay" id="overlayy"></div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <main>

        <!-- Breadcrumb Area Start -->
        <section class="breadcrumb-area mt-15" style="padding: 0px !important;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../index.html">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ ucwords($data['menu_bottom']) }}</li>
                            </ol>
                        </nav>
                        <h5>{{ ucwords($data['menu_bottom']) }}</h5>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Area End -->

        <!--Acount Area Start -->
        <section class="account">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Dashboard-Nav  Start-->
                        <div class="dashboard-nav" style="margin-bottom: 0px;">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="{{ route('orangTua.index') }}"
                                        class="{{ $data['menu_bottom'] === 'pengaturan' ? 'active' : '' }}">Pengaturan</a>
                                </li>
                                <li class="list-inline-item"><a href="{{ route('orangTua.dataOrangTua') }}"
                                        class="{{ $data['menu_bottom'] === 'data orang tua' ? 'active' : '' }}">Data
                                        Orang
                                        Tua</a>
                                </li>
                                <li class="list-inline-item"><a href="{{ route('orangTua.dataSiswa') }}"
                                        class="{{ $data['menu_bottom'] === 'data siswa' ? 'active' : '' }}">Data
                                        siswa</a></li>
                                <li class="list-inline-item"><a href="{{ route('orangTua.pendaftaranSiswa') }}"
                                        class="{{ $data['menu_bottom'] === 'pendaftaran siswa' ? 'active' : '' }}">Pendaftaran
                                        Awal Siswa</a>
                                </li>
                                <li class="list-inline-item mt-4"><a
                                        href="{{ route('orangTua.pendaftaranUlangSiswa') }}"
                                        class="{{ $data['menu_bottom'] === 'pendaftaran ulang siswa' ? 'active' : '' }}">Pendaftaran
                                        Ulang Siswa</a>
                                </li>
                                <li class="list-inline-item mt-4"><a
                                        href="{{ route('orangTua.dataPembayaranSiswa') }}"
                                        class="{{ $data['menu_bottom'] === 'pembayaran' ? 'active' : '' }}">Pembayaran
                                        Siswa</a>
                                </li>
                                <li class="list-inline-item"><a href="{{ route('logout_orang_tua') }}"
                                        class="mr-0">Keluar</a></li>
                            </ul>
                        </div>
                        <!-- Dashboard-Nav  End-->
                    </div>
                    @yield('data')
                </div>
            </div>
        </section>
        <!--Acount Area End -->

    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row main-footer">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="main-footer-info">
                        <h2 class="text-white">TK Nirata II</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam molestie malesuada
                            metus, non molestie ligula laoreet vitae. Ut et fringilla risus, vel.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="main-footer-quicklinks">
                        <h6>TK Nirata II</h6>
                        <ul class="quicklink">
                            <li><a href="#">Beranda</a></li>
                            <li><a href="#">Profil</a></li>
                            {{-- <li><a href="#">Galeri</a></li> --}}
                            <li><a href="#">Pengumuman</a></li>
                            <li><a href="#">Kegiatan</a></li>
                            <li><a href="#">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="main-footer-quicklinks">
                        <h6>Menu Cepat</h6>
                        <ul class="quicklink">
                            <li><a href="#">Pendaftaran</a></li>
                            <li><a href="#">Pengumuman</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="main-footer-quicklinks">
                        <h6>Pengguna</h6>
                        <ul class="quicklink">
                            <li><a href="#">Pofil</a></li>
                            <li><a href="#">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright d-flex justify-content-between align-items-center">
                        <div class="copyright-text order-2 order-lg-1">
                            <p>&copy; 2023. TK Nirata II</p>
                        </div>
                        <div class="copyright-links order-1 order-lg-2">
                            <a href="#" class="ml-0"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <script src="{{ asset('front/src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/src/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/src/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/src/scss/vendors/plugin/js/slick.min.js') }}"></script>
    <script src="{{ asset('front/src/scss/vendors/plugin/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('front/dist/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('DataTables/datatables.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.DataTables').DataTable({
                pageLength: 10,
                language: {
                    url: "{{ asset('/DataTables/bahasa.json') }}",
                }
            });
            if ('{{ session()->has('success') }}') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3300,

                })
            } else if ('{{ session()->has('warning') }}') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: '{{ session('warning') }}',
                    showConfirmButton: false,
                    timer: 3300,

                })
            } else if ('{{ session()->has('error') }}') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3300,

                })
            }
        });
    </script>

    <script>
        function openNav() {

            document.getElementById("mySidenav").style.width = "350px";
            $('#overlayy').addClass("active");
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            $('#overlayy').removeClass("active");
        }
    </script>

    <script>
        function validasiPass() {
            var password_baru = document.getElementById('password_user');
            var konfirmasi_password = document.getElementById('konfirmasi_password_user');
            var btn_profile = document.getElementById('btn_simpan');

            if (String(password_baru.value).length < 6 || String(konfirmasi_password.value).length < 6) {
                btn_profile.disabled = true;
            } else {
                btn_profile.disabled = false;
            }

            if (password_baru.value == "" && konfirmasi_password.value == "") {
                btn_profile.disabled = false;
                this.style.borderColor = "";
                konfirmasi_password.placeholder = 'Konfirmasi Password';
            }

            if (password_baru.value != "" && konfirmasi_password.value != "") {
                if (password_baru.value != konfirmasi_password.value) {
                    konfirmasi_password.style.borderColor = "red";
                    konfirmasi_password.placeholder = 'Password Tidak Sama!';
                    konfirmasi_password.value = "";
                    konfirmasi_password.focus();
                    btn_profile.disabled = true;
                } else if (String(password_baru.value).length < 6 || String(konfirmasi_password.value).length < 6) {
                    konfirmasi_password.style.borderColor = "red";
                    konfirmasi_password.placeholder = 'Minimal 6 Karakter!';
                    konfirmasi_password.value = "";
                    konfirmasi_password.focus();
                }
            }

        }


        document.getElementById('konfirmasi_password_user').addEventListener('keyup', function() {
            this.style.borderColor = "";
        });
    </script>
</body>
