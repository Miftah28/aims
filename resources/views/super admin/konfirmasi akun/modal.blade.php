@foreach ($admin as $akuns )
<!-- konfirmasi admin -->
<div class="modal fade" id="konfirmasi{{ $akuns->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Konfirmasi Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('SuperAdmin.konfirmasi-akun.konfirmasi', Crypt::encrypt($akuns->id)) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <h4 class="text-center">Apakah Anda Ingin Terima Permintaan Konfirmasi Data Ini?</h4>
                    <h5 class="text-center">Nama: {{ $akuns->admin->name }} </h5>
                    <div class="col-12 mb-3">
                        <label for="keterangan" class="form-label"><span style="color: red;">*</span>
                            keterangan</label>
                        <textarea id="keterangan" type="text" class="form-control"
                            name="keterangan"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    Kembali</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Terima</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- tolak konfirmasi admin -->
<div class="modal fade" id="tolakkonfirmasi{{ $akuns->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Konfirmasi Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('SuperAdmin.konfirmasi-akun.tolak-konfirmasi', Crypt::encrypt($akuns->id)) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <h4 class="text-center">Apakah Anda Ingin Tolak Permintaan Konfirmasi Data Ini?</h4>
                    <h5 class="text-center">Nama: {{ $akuns->admin->name }} </h5>
                    <div class="col-12 mb-3">
                        <label for="keterangan" class="form-label"><span style="color: red;">*</span>
                            keterangan</label>
                        <textarea id="keterangan" type="text" class="form-control"
                            name="keterangan"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    Kembali</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Tolak</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach