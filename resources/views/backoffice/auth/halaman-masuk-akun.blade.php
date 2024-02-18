<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TK Nirartha II</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/back/css/main.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-9 pt-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center pb-5">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="{{ route('auth.login.login_pegawai') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                placeholder="Enter email..." name="email" required>
                                            <div class="invalid-feedback">
                                                error
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                placeholder="Enter password..." name="password" required>
                                            <div class="invalid-feedback">
                                                error
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="form-check-input"
                                                    id="inputCheck-showPassword" onclick="showPass('password')">
                                                <label class="form-check-label" for="customCheck">Show Password</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/back/js/main.js') }}"></script>
    <script src="{{ asset('/back/js/custom.js') }}"></script>
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
    </script>
    <script>
        function showPass(id) {
            var input = $(`#${id}`);
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        }
    </script>
</body>

</html>
