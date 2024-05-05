{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="en">

@include('layouts.admin.component.head')
<style>
    #message {
        display: none;
    }

    #message p {
        font-size: 12px;
    }

    .valid {
        color: green;
    }

    .valid:before {
        content: "✔";
        font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;

    }

    .invalid {
        color: red;
    }

    .invalid:before {
        content: "✖";
        font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
    }
</style>

<body>
    @include('sweetalert::alert')
    {{-- @include('layouts.component.header') --}}

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form class="row g-3 needs-validation"method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="instansi" class="form-label">Instansi</label>
                                            <input type="text" name="instansi" class="form-control" id="instansi"
                                                required>
                                            <div class="invalid-feedback">Masukan Nama Instansi</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" id="name" required>
                                            <div class="invalid-feedback">Masukan Nama Lengkap</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="username" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="username" class="form-control" id="username"
                                                    required>
                                                <div class="invalid-feedback">Masukan Email.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="newpass" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="newpass"
                                                required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                            <div class="alert alert-secondary mt-2 mb-0" role="alert" id="message">
                                                <p style="font-weight: bold;"> Kata Sandi harus terdiri dari: </p>
                                                <p id="length" class="invalid"> Minimal <b> 8 karakter </b> </p>
                                                <p id="letter" class="invalid"> Huruf <b> kecil (a-z)</b> </p>
                                                <p id="capital" class="invalid"> Huruf <b> KAPITAL (A-Z)</b></p>
                                                <p id="number" class="invalid"> <b>Angka</b>(0-9) </p>
                                                <p id="symbol" class="invalid"> <b>Symbol</b>(!$#%@)</p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password-confirm" class="form-label">{{ __('Confirm
                                                Password') }}</label>
                
                                            {{-- <div class="col-md-6"> --}}
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            {{-- </div> --}}
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah Buat Akun? <a href="{{route('login')}}">Log
                                                    in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
    @include('layouts.admin.component.js')
    <script>
        function togglePasswordLoginVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordToggleIcon = document.getElementById("password-toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.classList.remove("bi-eye-slash");
                passwordToggleIcon.classList.add("bi-eye");
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.classList.remove("bi-eye");
                passwordToggleIcon.classList.add("bi-eye-slash");
            }
        }
    </script>

    <script>
        var myInput = document.getElementById("newpass");
        var retype = document.getElementById("retype");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var symbol = document.getElementById("symbol");
        var length = document.getElementById("length");
        var feedback = document.getElementById("feedback");
        var progress = document.getElementsByClassName("progress-bar");

        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        myInput.onkeyup = function() {
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }

            var Symbols = /[!$#%@]/g;
            if (myInput.value.match(Symbols)) {
                symbol.classList.remove("invalid");
                symbol.classList.add("valid");
            } else {
                symbol.classList.remove("valid");
                symbol.classList.add("invalid");
            }


        }

        // retype.onfocus = function() {
        //     document.getElementById("feedback").style.display = "block";
        // }

        // retype.onblur = function() {
        //     document.getElementById("feedback").style.display = "none";
        // }
    </script>

</body>

</html>