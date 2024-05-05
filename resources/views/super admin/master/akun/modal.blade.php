<!-- Tambah Super Admin dan Admin -->
<div class="modal fade" id="create" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.master.akun.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="username" class="form-label"><span style="color: red;">*</span>
                                    Username/email</label>
                                <input id="username" type="text" class="form-control" name="username"
                                    value="{{ old('username') }}" placeholder="email untuk akun admin" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label"><span style="color: red;">*</span>
                                    Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukan Nama Lengkap"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label"><span style="color: red;">*</span>
                                Nama Instansi</label>
                            <input id="instansi" type="text" class="form-control" name="instansi"
                                value="{{ old('instansi') }}">
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label"><span style="color: red;">*</span>
                                    Jabatan</label>
                                <select class="js-example-basic-single form-select" name="role" id="role-create"
                                    required>
                                    <option value="">Pilih Jabatan</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label"><span style="color: red;">*</span>
                                    Status</label>
                                <select class="js-example-basic-single form-select" name="status" id="status-create"
                                    required>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label"><span style="color: red;">*</span> image</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div><!-- End Create Modal-->

@foreach ($akun as $akuns)
<!-- Form edit Super Admin dan admin -->
<div class="modal fade" id="edit{{ $akuns->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit -->
                <form method="POST" action="{{ route('SuperAdmin.master.akun.update', Crypt::encrypt($akuns->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input id="image" type="file" class="form-control preview-image" name="image"
                            value="{{ old('image') }}" accept="image/*">
                    </div>
                    
                    @if ($akuns->role === 'superadmin')
                    <div class="mb-3">
                        <label for="username"> <span style="color: red;">*</span> Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ $akuns->username }}">
                    </div>
                    <div class=" mb-3">
                        <label for="name" class="form-label"><span style="color: red;">*</span>
                            Nama Lengkap</label>
                        <input id="name" type="text" class="form-control" name="name"
                            value="{{ datasuperadmin($akuns->id) ? datasuperadmin($akuns->id)->name : 'Nama tidak tersedia' }}">
                    </div>
                    @elseif ($akuns->role === 'admin')
                    <div class="mb-3">
                        <label for="username"> <span style="color: red;">*</span> Email</label>
                        <input type="email" name="username" id="username" class="form-control"
                            value="{{ $akuns->username }}">
                    </div>
                    <div class=" mb-3">
                        <label for="name" class="form-label"><span style="color: red;">*</span>
                            Nama Lengkap</label>
                        <input id="name" type="text" class="form-control" name="name"
                            value="{{ dataadmin($akuns->id) ? dataadmin($akuns->id)->name : 'Nama tidak tersedia' }}">
                    </div>
                    <div class="mb-3">
                        <label for="instansi" class="form-label"><span style="color: red;">*</span>
                            Nama Instansi</label>
                        <input id="instansi" type="text" class="form-control" name="instansi"
                            value="{{ $akuns->admin->instansi }}">
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="role" class="form-label">
                            role</label>
                        <input id="role" type="text" class="form-control" name="role" value="{{ $akuns->role }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="col-md-4 control-label" for="password">Password</label>
                        <input id="new_password{{ $akuns->id }}" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            pattern="^.*(?=.*[A-Za-z0-9])(?=.{8,}).*$"
                            title="Password harus terdiri dari minimal 8 karakter yang terdiri dari huruf dan/atau angka"
                            autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="col-md-10 control-label">Konfirmasi Password</label>
                        <input id="password-confirm{{ $akuns->id }}" type="password" class="form-control"
                            name="password_confirmation" autocomplete="new-password">
                        <div id="password-error{{ $akuns->id }}" class="invalid-feedback" style="display: none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i> Tutup
                        </button>
                        <button onclick="validatePassword({{ $akuns->id }})" type="submit" class="btn btn-success">
                            <i class="fa fa-check-square-o"></i> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambah petugas -->
<div class="modal fade" id="tambahpetugas{{$akuns->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Akun Petugas pada instansi {{dataadmin($akuns->id) ? dataadmin($akuns->id)->instansi :'Tidak ada instansi'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.master.akun.storepetugas', Crypt::encrypt($akuns->id)) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 mb-3">
                                <label for="instansi" class="form-label">
                                    instansi</label>
                                <input id="instansi" type="text" class="form-control" name="instansi"
                                    value="{{dataadmin($akuns->id) ? dataadmin($akuns->id)->instansi :'Tidak ada instansi'}}" disabled>
                            </div>
                            {{-- <div class="col-6 mb-3">
                                <label for="username" class="form-label"><span style="color: red;">*</span>
                                    Email</label>
                                <input id="username" type="email" class="form-control" name="username"
                                    value="{{ old('username') }}" required>
                            </div> --}}
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label"><span style="color: red;">*</span>
                                    Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="email" class="form-label"><span style="color: red;">*</span>
                                    email</label>
                                <input id="email" type="email" class="form-control" name="username"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="no_hp" class="form-label"><span style="color: red;">*</span>
                                    no_hp</label>
                                <input id="no_hp" type="number" class="form-control" name="no_hp"
                                    value="{{ old('no_hp') }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label"><span style="color: red;">*</span>
                                    Alamat</label>
                                <textarea id="alamat" type="text" class="form-control" name="alamat"
                                    value="{{ old('alamat') }}" required></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label"><span style="color: red;">*</span> image</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div><!-- End Create petugas Modal-->

<!-- Delete super admin dan admin-petugas -->
<div class="modal fade" id="delete{{ $akuns->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.master.akun.destroy', Crypt::encrypt($akuns->id)) }}">
                    @csrf
                    @method('DELETE')
                    <h4 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h4>
                    <h5 class="text-center">Nama: {{ $akuns->username }} </h5>
                    <h5 class="text-center">Jabatan: {{ $akuns->role }}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    kembali</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach (petugas() as $petugas)
<!-- edit petugas -->
<div class="modal fade" id="editpetugas{{$petugas->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.master.akun.updatepetugas', Crypt::encrypt($petugas->id)) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 mb-3">
                                <label for="instansi" class="form-label"><span style="color: red;">*</span>
                                    instansi</label>
                                <input id="instansi" type="text" class="form-control" name="instansi"
                                    value="{{ $petugas->admin->instansi }}" disabled>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="image" class="form-label"><span style="color: red;">*</span> image</label>
                                <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png">
                            </div>
                            {{-- <div class="col-6 mb-3">
                                <label for="username" class="form-label"><span style="color: red;">*</span>
                                    Username</label>
                                <input id="username" type="text" class="form-control" name="username"
                                    value="{{ $petugas->user->username }}" >
                            </div> --}}
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label"><span style="color: red;">*</span>
                                    Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $petugas->name }}">
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="username" class="form-label"><span style="color: red;">*</span>
                                    email</label>
                                <input id="username" type="email" class="form-control" name="username"
                                    value="{{ $petugas->user->username }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="no_hp" class="form-label"><span style="color: red;">*</span>
                                    no_hp</label>
                                <input id="no_hp" type="number" class="form-control" name="no_hp"
                                    value="{{ $petugas->no_hp }}" >
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label"><span style="color: red;">*</span>
                                    Alamat</label>
                                <textarea id="alamat" type="text" class="form-control" name="alamat"
                                    >{{$petugas->alamat}}</textarea>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="col-md-4 control-label" for="password">Password</label>
                                <input id="new_password{{ $petugas->id }}" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    pattern="^.*(?=.*[A-Za-z0-9])(?=.{8,}).*$"
                                    title="Password harus terdiri dari minimal 8 karakter yang terdiri dari huruf dan/atau angka"
                                    autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
        
                            <div class="col-6 mb-3">
                                <label for="password-confirm" class="col-md-10 control-label">Konfirmasi Password</label>
                                <input id="password-confirm{{ $petugas->id }}" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                                <div id="password-error{{ $petugas->id }}" class="invalid-feedback" style="display: none;"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div><!-- End edit petugas Modal-->

<!-- Delete petugas -->
<div class="modal fade" id="deletepetugas{{ $petugas->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.master.akun.destroypetugas', Crypt::encrypt($petugas->id)) }}">
                    @csrf
                    @method('DELETE')
                    <h4 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h4>
                    <h5 class="text-center">Nama: {{ $petugas->user->username }} </h5>
                    <h5 class="text-center">Jabatan: {{ $petugas->user->role }}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    kembali</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
