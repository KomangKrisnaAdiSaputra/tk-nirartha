<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TK Nirata II - Beranda</title>
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
                            <a href="{{ url('landing/') }}">
                                <h2>TK Nirata II</h2>
                            </a>
                        </div>
                        <ul class="main-menu d-flex align-items-center">
                            <li><a class="{{ $menu == 'beranda' ? 'active' : '' }}"
                                    href="{{ url('landing/') }}">Beranda</a></li>
                            <li><a class="{{ $menu == 'profil' ? 'active' : '' }}"
                                    href="{{ url('landing/profil') }}">Profil</a></li>
                            {{-- <li><a class="{{ ($menu == 'galeri') ? 'active' : '' }}" href="{{ url('landing/galeri') }}">Galeri</a></li> --}}
                            <li><a class="{{ $menu == 'pengumuman' ? 'active' : '' }}"
                                    href="{{ url('landing/pengumuman') }}">Pengumuman</a></li>
                            <li><a class="{{ $menu == 'kegiatan' ? 'active' : '' }}"
                                    href="{{ url('landing/kegiatan') }}">Kegiatan</a></li>
                            <li><a class="{{ $menu == 'kontak' ? 'active' : '' }}"
                                    href="{{ url('landing/kontak') }}">Kontak</a></li>
                        </ul>
                        <div class="col align-items-center">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-link me-md-2"
                                    href="{{ url('secure/auth/login/orangtua') }}">Masuk</a>
                                <a class="btn bg-primary"
                                    href="{{ url('secure/auth/register/orangtua') }}">Pendaftaran</a>
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
                                <h2>TK Kumara II</h2>
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

    <!-- Main Area -->
    @yield('main')
    <!-- Main Area End -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row main-footer">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="main-footer-info">
                        <h2 class="text-white">TK Kumaran II</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam molestie malesuada
                            metus, non molestie ligula laoreet vitae. Ut et fringilla risus, vel.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="main-footer-quicklinks">
                        <h6>TK Nirata I</h6>
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
                            <p>&copy; {{ date('Y') }}. TK Kumara II</p>
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

    <!-- firebase -->
    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
        import {
            getAnalytics
        } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyBp3KnLn0QdFhKIA7S8zf-lfFDeJNHJnVM",
            authDomain: "tk-nirartha.firebaseapp.com",
            databaseURL: "https://tk-nirartha-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "tk-nirartha",
            storageBucket: "tk-nirartha.appspot.com",
            messagingSenderId: "893394044292",
            appId: "1:893394044292:web:c5c8f7dd54d9ad3228c9d1",
            measurementId: "G-ZTTXZ0DF0B"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>

    <!-- asset -->
    <script src="{{ asset('front/src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/src/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
