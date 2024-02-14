<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TK Niratha II - Akun</title>
    <link rel="stylesheet" href="{{ asset('front/dist/main.css') }}">
</head>

<body>
    @yield('main')
    <script src="{{ asset('front/src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/src/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/dist/main.js') }}"></script>
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

        function showPass(id, idd) {
            var input = $(`#${id}`);
            var input2 = $(`#${idd}`);
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

            if (input2.attr("type") === "password") {
                input2.attr("type", "text");
            } else {
                input2.attr("type", "password");
            }
        }

        function showPassOne(id) {
            var input = $(`#${id}`);
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        }
    </script>
</body>
