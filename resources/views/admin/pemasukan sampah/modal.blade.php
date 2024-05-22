<!-- tamabah Pemasukan Sampah --->
<div class="modal fade" id="create" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Pemasukan Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Admin.pemasukan-sampah.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 mb-3">
                                <label for="nasabah_id" class="form-label"><span style="color: red;">*</span>
                                    Nasabah</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%"
                                    name="nasabah_id" required>
                                    <option value="">Pilih Nasabah (jika memiliki akun) </option>
                                    @forelse ($nasabah as $nasabahs)
                                    <option value="{{ $nasabahs->id }}">{{ $nasabahs->name }}, Kode Pengguna:
                                        {{$nasabahs->kode_pengguna}}</option>
                                    @empty
                                    <option value="NULL">Nasabah belum diinput</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="kategori_sampah_id" class="form-label"><span style="color: red;">*</span>
                                    Jenis Sampah</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%" name="kategori_sampah_id"
                                    required>
                                    <option value="">Pilih Jenis Sampah </option>
                                    @forelse ($kategorisampah as $kategoriSampahs)
                                    <option value="{{ $kategoriSampahs->id }}">{{
                                        $kategoriSampahs->jenis_sampah }}</option>
                                    @empty
                                    <option value="NULL" disabled>Jenis Sampah belum diinput</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="pemasukan_sampah" class="form-label"><span style="color: red;">*</span>
                                    Berat Sampah</label>
                                <input id="pemasukan_sampah" type="number" class="form-control" name="pemasukan_sampah"
                                    step="0.1" required>
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


<!-- edit Pemasukan sampah -->
@foreach ($sampah as $sampahs )
<div class="modal fade" id="edit{{$sampahs->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pemasukan Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Admin.pemasukan-sampah.update', Crypt::encrypt($sampahs->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 mb-3">
                                <label for="nasabah_id" class="form-label"><span style="color: red;">*</span>
                                    Nasabah</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%"
                                    name="nasabah_id" required>
                                    <option value="">Pilih Nasabah (jika memiliki akun) </option>
                                    @forelse ($nasabah as $nasabahs)
                                    <option value="{{ $nasabahs->id }}" {{ $sampahs->nasabah_id == $nasabahs->id ?
                                        'selected' : ''
                                        }}>
                                        {{ $nasabahs->name }}</option>
                                    @empty
                                    <option value="NULL">Nasabah belum diinput</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="kategori_sampah_id" class="form-label"><span style="color: red;">*</span>
                                    Jenis Sampah</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%" name="kategori_sampah_id"
                                    required>
                                    <option value="">Pilih Jenis Sampah </option>
                                    @forelse ($kategorisampah as $kategorisampahs)
                                    <option value="{{ $kategorisampahs->id }}" {{ $sampahs->kategoriSampah->id ==
                                        $kategorisampahs->id ? 'selected' : ''
                                        }}>
                                        {{ $kategorisampahs->jenis_sampah }}</option>
                                    @empty
                                    <option value="NULL" disabled>Jenis Sampah belum diinput</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="pemasukan_sampah" class="form-label"><span style="color: red;">*</span>
                                    Berat Sampah</label>
                                <input id="pemasukan_sampah" type="number" class="form-control" name="pemasukan_sampah"
                                    value="{{$sampahs->pemasukan_sampah}}" step="0.1">
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
</div><!-- End edit Pemasukan sampah Modal-->

<!-- delete Pemasukan sampah -->
<div class="modal fade" id="delete{{ $sampahs->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Pemasukan Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.pemasukan-sampah.destroy', Crypt::encrypt($sampahs->id)) }}">
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