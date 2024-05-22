<!-- tamabah kelola poin --->
<div class="modal fade" id="create" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Data Poin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Admin.manajemen-sampah.kelola-poin.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            {{-- <div class="col-12 mb-3">
                                <label for="kategori_sampah_id" class="form-label"><span style="color: red;">*</span>
                                    Jenis Sampah</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%"
                                    name="kategori_sampah_id">
                                    <option value="">Pilih Jenis Sampah </option>
                                    @forelse ($kategori as $kategoris)
                                    <option value="{{ $kategoris->id }}">{{ $kategoris->jenis_sampah }}</option>
                                    @empty
                                    <option value="NULL">Jenis Sampah belum diinput</option>
                                    @endforelse
                                </select>
                            </div> --}}
                            <div class="col-6 mb-3">
                                <label for="jumlah_poin" class="form-label"><span style="color: red;">*</span>
                                    Jumlah Poin</label>
                                <input id="jumlah_poin" type="number" class="form-control" name="jumlah_poin" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="jumlah_saldo" class="form-label"><span style="color: red;">*</span>
                                    Jumlah Saldo</label>
                                <input id="jumlah_saldo" type="number" class="form-control" name="jumlah_saldo"
                                    required>
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

<!-- edit kelola poin -->
@foreach ($poin as $poins )
<div class="modal fade" id="edit{{$poins->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Poin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.manajemen-sampah.kelola-poin.update', Crypt::encrypt($poins->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="container">
                        <div class="row justify-content-start">
                            {{-- <div class="col-12 mb-3">
                                <label for="kategori_sampah_id" class="form-label"><span style="color: red;">*</span>
                                    Jenis Sampah</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%" name="kategori_sampah_id"
                                    id="kategori_sampah_id" required>
                                    <option value="">Pilih Jenis Sampah</option>
                                    @forelse ($kategori as $kategoris)
                                    <option value="{{ $kategoris->id }}" {{ $poins->kategori_sampah_id == $kategoris->id ? 'selected' :
                                        ''
                                        }}>
                                        {{ $kategoris->jenis_sampah }}</option>
                                    @empty
                                    <option value="NULL">Jenis Sampah belum diinput</option>
                                    @endforelse
                                </select>
                            </div> --}}
                            <div class="col-6 mb-3">
                                <label for="jumlah_poin" class="form-label"><span style="color: red;">*</span>
                                    Jumlah Poin</label>
                                <input id="jumlah_poin" type="number" class="form-control" name="jumlah_poin"
                                    value="{{ $poins->jumlah_poin }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="jumlah_saldo" class="form-label"><span style="color: red;">*</span>
                                    Jumlah Saldo</label>
                                <input id="jumlah_saldo" type="number" class="form-control" name="jumlah_saldo"
                                    value="{{ $poins->jumlah_saldo }}">
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
</div>
</div><!-- End edit kelola poin Modal-->

<!-- delete kelola poin -->
<div class="modal fade" id="delete{{ $poins->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Data Poin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.manajemen-sampah.kelola-poin.destroy', Crypt::encrypt($poins->id)) }}">
                    @csrf
                    @method('DELETE')
                    <h4 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h4>
                    <h5 class="text-center">Jumlah Poin: {{ $poins->jumlah_poin }} </h5>
                    <h5 class="text-center">Jumlah Saldo: Rp. {{ number_format($poins->jumlah_saldo, 0, ',', '.') }}
                    </h5>
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