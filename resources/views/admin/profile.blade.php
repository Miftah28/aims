@extends('layouts.admin.index')

@section('main-content')
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

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    @if($admin->image != null )
                    <img src="{{ asset('storage/'.$admin->image) }}" class="rounded-circle" style="max-width: 50%;" />
                    @else
                    <img src="{{ asset('images/preview.png') }}" class="rounded-circle" style="max-width: 50%;" />
                    @endif
                    <h2>{{$admin->name}}</h2>
                    <h3>{{$admin->user->role}}</h3>
                    <div class="social-links mt-2">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#profile-change-password">Change Password</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{$admin->name}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{$admin->user->username}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Instansi</div>
                                <div class="col-lg-9 col-md-8">{{$admin->instansi}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jabatan</div>
                                <div class="col-lg-9 col-md-8">{{$admin->user->role}}</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="POST" action="{{ route('Admin.profile.update') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                        Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input id="image" type="file" class="form-control preview-image" name="image"
                                            value="{{ old('image') }}" accept="image/*">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="name"
                                            value="{{$admin->name}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="username" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="username" type="email" class="form-control" id="username"
                                            value="{{$admin->user->username}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="instansi" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="instansi" type="text" class="form-control" id="instansi"
                                            value="{{$admin->instansi}}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="role" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="role" type="text" class="form-control" id="role"
                                            value="{{$admin->user->role}}" readonly>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="POST" action="{{ route('SuperAdmin.profile.reset') }}" autocomplete="off">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="hidden" name="_method" value="PUT">

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="password" id="current_password" class="form-control"
                                            name="current_password" placeholder="Current password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="input-group">
                                            <input id="new_password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="new_password" required autocomplete="new-password"
                                                pattern="^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!$#%@]).*$" placeholder="New password">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="togglePasswordVisibility()">
                                                <i id="password-toggle-icon" class="bi bi-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                        <div class="alert alert-secondary mt-2 mb-0" role="alert" id="message">
                                            <p style="font-weight: bold;">Kata Sandi harus terdiri dari:</p>
                                            <p id="length" class="invalid">Minimal <b>8 karakter</b></p>
                                            <p id="letter" class="invalid">Huruf <b>kecil (a-z)</b></p>
                                            <p id="capital" class="invalid">Huruf <b>KAPITAL (A-Z)</b></p>
                                            <p id="number" class="invalid"><b>Angka</b> (0-9)</p>
                                            <p id="symbol" class="invalid"><b>Symbol</b> (!$#%@)</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="password" id="confirm_password" class="form-control"
                                            name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Include jQuery and Select2 scripts if not already included -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {

        // Initialize Select2 for the edit modals (loop through each edit modal)

        $('#jabatanedit, #dinas_idedit').select2({
            theme: 'bootstrap',
            dropdownParent: $('#profile-edit')
        });
    });
</script>

<script>
    var myInput = document.getElementById("new_password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var symbol = document.getElementById("symbol");
    var length = document.getElementById("length");

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

        var numbers = /\d/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        var symbols = /[!$#%@]/g;
        if (myInput.value.match(symbols)) {
            symbol.classList.remove("invalid");
            symbol.classList.add("valid");
        } else {
            symbol.classList.remove("valid");
            symbol.classList.add("invalid");
        }

        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
</script>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("new_password");
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
@endsection
