<!-- tamabah Kategori Sampah --->
<div class="modal fade" id="create" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Kategori Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Admin.manajemen-sampah.ketegori-sampah.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="jenis_sampah" class="form-label"><span style="color: red;">*</span>
                                    Jenis Sampah</label>
                                <input id="jenis_sampah" type="text" class="form-control" name="jenis_sampah" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="berat_sampah" class="form-label"><span style="color: red;">*</span>
                                    Berat Sampah</label>
                                <input id="berat_sampah" type="number" class="form-control" name="berat_sampah"
                                    required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="poin_sampah" class="form-label"><span style="color: red;">*</span>
                                    Poin Perberat Sampah</label>
                                <input id="poin_sampah" type="number" class="form-control" name="poin_sampah" required>
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
</div><!-- End Create Modal-->

<!-- edit kategori sampah -->
@foreach ($kategori as $kategoris )
<div class="modal fade" id="edit{{$kategoris->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.manajemen-sampah.ketegori-sampah.update', Crypt::encrypt($kategoris->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="jenis_sampah" class="form-label"><span style="color: red;">*</span>
                                    Jenis Sampah</label>
                                <input id="jenis_sampah" type="text" class="form-control" name="jenis_sampah"
                                    value="{{ $kategoris->jenis_sampah }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="berat_sampah" class="form-label"><span style="color: red;">*</span>
                                    Berat Sampah</label>
                                <input id="berat_sampah" type="number" class="form-control" name="berat_sampah"
                                    value="{{ $kategoris->berat_sampah }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="poin_sampah" class="form-label"><span style="color: red;">*</span>
                                    Poin Sampah</label>
                                <input id="poin_sampah" type="number" class="form-control" name="poin_sampah"
                                    value="{{ $kategoris->poin_sampah }}">
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
<div class="modal fade" id="delete{{ $kategoris->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Kategori Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.manajemen-sampah.ketegori-sampah.destroy', Crypt::encrypt($kategoris->id)) }}">
                    @csrf
                    @method('DELETE')
                    <h4 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h4>
                    <h5 class="text-center">Jenis Sampah: {{ $kategoris->jenis_sampah }} </h5>
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