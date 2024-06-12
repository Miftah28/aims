<div class="modal fade" id="lihat" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                @if ($setting->logo)
                <img src="{{ asset('storage/'.$setting->logo) }}" class="rounded-circle" style="max-width: 50%;"
                    alt="Logo">
                @else
                <img src="{{ url('images/preview.png') }}" alt="Preview">
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@foreach ($team as $teams )

<div class="modal fade" id="lihatfoto{{$teams->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($teams->foto)
                <div class="row">
                    <div class="col-12 mb-3 text-center">
                        <img src="{{ asset('storage/'.$teams->foto) }}" class="rounded-circle" style="max-width: 50%;"
                            alt="Logo">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="deskripsi" class="form-label">
                            Deskripsi</label>
                        <textarea id="deskripsi" type="text" class="form-control"
                            name="deskripsi" readonly>{{$teams->deskripsi}}</textarea>
                    </div>
                </div>
                @else
                <img src="{{ url('images/preview.png') }}" alt="Preview">
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit{{$teams->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EditTeam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.setting.update-team', Crypt::encrypt($teams->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 mb-3">
                                <label for="foto" class="form-label"><span style="color: red;">*</span> Foto</label>
                                <input id="foto" type="file" class="form-control preview-image" name="foto"
                                    accept="image/*" >
                            </div>
                            <div class="col-6 mb-3">
                                <label for="nama" class="form-label"><span style="color: red;">*</span>
                                    Nama Lengkap</label>
                                <input id="nama" type="text" class="form-control" name="nama" value="{{$teams->nama}}"
                                    required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="jabatan" class="form-label"><span style="color: red;">*</span>
                                    Jabatan</label>
                                <input id="jabatan" type="text" class="form-control" name="jabatan"
                                    value="{{$teams->jabatan}}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="deskripsi" class="form-label"><span style="color: red;">*</span>
                                    Deskripsi</label>
                                <textarea id="deskripsi" type="text" class="form-control" name="deskripsi" required
                                    value="{{$teams->deskripsi}}">{{$teams->deskripsi}}</textarea>
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
    </div>
</div><!-- End edit kategori sampah Modal-->

<!-- delete kategori sampah -->
<div class="modal fade" id="delete{{ $teams->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Kategori Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('SuperAdmin.setting.destroy-team', Crypt::encrypt($teams->id)) }}">
                    @csrf
                    @method('DELETE')
                    <h4 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h4>
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
