<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TK Niratha II - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('front/dist/main.css') }}">
    <link rel="stylesheet" href="{{ asset('front/dist/style-custom.css') }}">
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
                                        <span>tknirathaii@gmail.com</span>
                                    </div>
                                </div>
                                <div class="cta">
                                    <div class="icon">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div class="text">
                                        <span>+8801658 874521</span>
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
                            <a href="#">
                                <h2>TK Niratha II</h2>
                            </a>
                        </div>
                        <ul class="main-menu d-flex align-items-center">
                            <li><a href="../index.html">Beranda</a></li>
                            <li><a href="../profil.html">Profil</a></li>
                            <li><a href="../galeri.html">Galeri</a></li>
                            <li><a href="../pengumuman.html">Pengumuman</a></li>
                            <li><a href="kegiatan.html">Kegiatan</a>
                            </li>
                            <li><a href="../kontak.html">Kontak</a></li>
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
                        <li><a href="galeri.html">Galeri</a></li>
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
                                <h2>TK Niratha II</h2>
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
                                <li class="breadcrumb-item active" aria-current="page">Akun</li>
                            </ol>
                        </nav>
                        <h5>Akun</h5>
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
                                        siswa</a>
                                </li>
                                <li class="list-inline-item"><a href="#" class="mr-0">Keluar</a></li>
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
                        <h2 class="text-white">TK Nirathan II</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam molestie malesuada
                            metus, non molestie ligula laoreet vitae. Ut et fringilla risus, vel.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="main-footer-quicklinks">
                        <h6>TK Nirathan II</h6>
                        <ul class="quicklink">
                            <li><a href="#">Beranda</a></li>
                            <li><a href="#">Profil</a></li>
                            <li><a href="#">Galeri</a></li>
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
                            <p>&copy; 2023. TK Niratha II</p>
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
</body>
