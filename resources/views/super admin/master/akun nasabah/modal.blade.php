<!-- tamabah nasabah --->
<div class="modal fade" id="create" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Akun Nasabah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.master.akun-nasabah.store-nasabah') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label"><span style="color: red;">*</span>
                                    Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="username" class="form-label"><span style="color: red;">*</span>
                                    Email</label>
                                <input id="username" type="email" class="form-control" name="username"
                                    value="{{ old('username') }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="no_hp" class="form-label"><span style="color: red;">*</span>
                                    No Telepon</label>
                                <input id="no_hp" type="number" class="form-control" name="no_hp"
                                    value="{{ old('no_hp') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label"><span style="color: red;">*</span>
                                Alamat</label>
                            <textarea id="alamat" type="text" class="form-control" name="alamat"
                                value="{{ old('alamat') }}"></textarea>
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

<!-- edit nasabah -->
@foreach ($akun as $akuns )
<div class="modal fade" id="edit{{$akuns->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Nasabah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('SuperAdmin.master.akun-nasabah.update-nasabah', Crypt::encrypt($akuns->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label"><span style="color: red;">*</span>
                                    Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ $akuns->name }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="username" class="form-label"><span style="color: red;">*</span>
                                    email</label>
                                <input id="username" type="email" class="form-control" name="username"
                                    value="{{ $akuns->user->username }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="no_hp" class="form-label"><span style="color: red;">*</span>
                                    no_hp</label>
                                <input id="no_hp" type="number" class="form-control" name="no_hp"
                                    value="{{ $akuns->no_hp }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label"><span style="color: red;">*</span>
                                    Alamat</label>
                                <textarea id="alamat" type="text" class="form-control"
                                    name="alamat">{{$akuns->alamat}}</textarea>
                            </div>
                            <div class="col-6 mb-3">
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

                            <div class="col-6 mb-3">
                                <label for="password-confirm" class="col-md-10 control-label">Konfirmasi
                                    Password</label>
                                <input id="password-confirm{{ $akuns->id }}" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                                <div id="password-error{{ $akuns->id }}" class="invalid-feedback"
                                    style="display: none;"></div>
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
</div><!-- End edit nasabah Modal-->
<!-- delete nasabah -->
<div class="modal fade" id="delete{{ $akuns->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Nasabah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.master.akun-nasabah.destroy-nasabah', Crypt::encrypt($akuns->id)) }}">
                    @csrf
                    @method('DELETE')
                    <h4 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h4>
                    <h5 class="text-center">Nama: {{ $akuns->name }} </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    Kembali</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach