<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TK Nirartha II - {{ ucwords($menu) }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="{{ asset('back/css/main.css') }}" rel="stylesheet">
    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Atur animasi untuk ikon */
        .spinner-icon {
            animation: spin 1s linear infinite;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
                <div class="sidebar-brand-text mx-3">TK Nirartha <sup>II</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard/') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fitur
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ $menu == 'pendaftaran' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fab fa-wpforms"></i>
                    <span>Pendaftaran</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="{{ route('pendaftaranAwal.index') }}">Pendaftaran Awal</a>
                        <a class="collapse-item" href="{{ route('pendaftaranUlang.index') }}">Pendaftaran Ulang</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ $menu == 'pembayaran' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pembayaran.index') }}">
                    <i class="fas fa-money-check"></i>
                    <span>Pembayaran</span>
                </a>
            </li>

            <li class="nav-item {{ $menu == 'siswa' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('siswa.index') }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Siswa</span>
                </a>
            </li>
            @if ((string) getDataUser(session('firebaseUserId'))['tipe_user'] === '2')
                <li class="nav-item {{ $menu == 'kelas' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kelas.index') }}">
                        <i class="fas fa-school"></i>
                        <span>Kelas</span>
                    </a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Aktivitas
                </div>
                <li class="nav-item {{ $menu == 'pengumuman' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pengumuman.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengguna
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ $menu == 'pegawai' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Pegawai</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ getDataUser(session('firebaseUserId'))['username_user'] }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('back/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('pengaturan.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Page Content -->
                @yield('main')
                <!-- End Page Content -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; TK Nirartha II - {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('dashboard.logout_pegawai') }}">Logout</a>
                </div>

            </div>
            <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
            <script src="{{ asset('vendor/fontawesome-free/js/all.min.js') }}"></script>

            <!-- Main scripts for all pages-->
            <script src="{{ asset('back/js/main.js') }}"></script>
            <!-- Custom scripts for all pages-->
            <script src="{{ asset('back/js/custom.js') }}"></script>

            @if ($menu == 'dashboard')
                <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
                <script src="{{ asset('back/js/demo/chart-area-demo.js') }}"></script>
                <script src="{{ asset('back/js/demo/chart-pie-demo.js') }}"></script>
            @endif

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                $(document).ready(function() {
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
            @yield('js')
</body>

</html>
