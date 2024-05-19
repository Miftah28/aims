@foreach ($jadwal as $jadwals )
<!-- tamabah kelola Petugas Penjemputan sampah --->
<div class="modal fade" id="create{{$jadwals->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Data Jadwal Penjemputan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.manajemen-sampah.kelola-tugas.store', Crypt::encrypt($jadwals->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 mb-3">
                                <label for="lokasi_id" class="form-label"><span style="color: red;">*</span>
                                    Lokasi</label>
                                <input id="lokasi_id" type="text" class="form-control" name="lokasi_id"
                                    value="{{$jadwals->lokasi->tempat}}" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="petugas_id" class="form-label"><span style="color: red;">*</span>
                                    petugas</label>
                                <select class="selectpicker" data-live-search="true" multiple data-width="100%"
                                    name="petugas_id[]">
                                    <option value="">Pilih petugas</option>
                                    @forelse ($petugas as $petugass)
                                    <option value="{{ $petugass->id }}">{{ $petugass->name }}</option>
                                    @empty
                                    <option value="NULL">petugas belum diinput</option>
                                    @endforelse
                                </select>

                            </div>
                            <div class="col-6 mb-3">
                                <label for="mulai_penjemputan" class="form-label"><span style="color: red;">*</span>
                                    Mulai Penjemputan</label>
                                <input id="mulai_penjemputan" type="datetime-local" class="form-control"
                                    name="mulai_penjemputan" value="{{$jadwals->mulai_penjemputan}}" readonly>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="selesai_penjemputan" class="form-label"><span style="color: red;">*</span>
                                    Selesai Penjemputan</label>
                                <input id="selesai_penjemputan" type="datetime-local" class="form-control"
                                    name="selesai_penjemputan" value="{{$jadwals->selesai_penjemputan}}" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label"><span style="color: red;">*</span>
                                    Keterangan</label>
                                <textarea id="keterangan" type="text" class="form-control" name="keterangan"
                                    readonly>{{$jadwals->keterangan}}</textarea>
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

<div class="modal fade" id="edit{{$jadwals->id}}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.manajemen-sampah.kelola-tugas.update', Crypt::encrypt($jadwals->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 mb-3">
                                <label for="lokasi_id" class="form-label"><span style="color: red;">*</span>
                                    Lokasi</label>
                                <input id="lokasi_id" type="text" class="form-control" name="lokasi_id"
                                    value="{{$jadwals->lokasi->tempat}}" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="petugas_id" class="form-label"><span style="color: red;">*</span>
                                    petugas</label>
                                <select class="selectpicker" data-live-search="true" multiple data-width="100%"
                                    name="petugas_id[]">
                                    <option value="">Pilih petugas</option>
                                    @forelse ($petugas as $petugass)
                                    <option value="{{ $petugass->id }}" {{ datajadwal($jadwals->id)->
                                        contains('petugas_id', $petugass->id) ? 'selected' : '' }}>
                                        {{ $petugass->name }}
                                    </option>
                                    @empty
                                    <option value="NULL">petugas belum diinput</option>
                                    @endforelse
                                </select>

                            </div>
                            <div class="col-6 mb-3">
                                <label for="mulai_penjemputan" class="form-label"><span style="color: red;">*</span>
                                    Mulai Penjemputan</label>
                                <input id="mulai_penjemputan" type="datetime-local" class="form-control"
                                    name="mulai_penjemputan" value="{{$jadwals->mulai_penjemputan}}" readonly>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="selesai_penjemputan" class="form-label"><span style="color: red;">*</span>
                                    Selesai Penjemputan</label>
                                <input id="selesai_penjemputan" type="datetime-local" class="form-control"
                                    name="selesai_penjemputan" value="{{$jadwals->selesai_penjemputan}}" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label"><span style="color: red;">*</span>
                                    Keterangan</label>
                                <textarea id="keterangan" type="text" class="form-control" name="keterangan"
                                    readonly>{{$jadwals->keterangan}}</textarea>
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
</div><!-- End edit kelola petugas jemput Modal-->

<!-- delete kelola jadwal penjemputan -->
<div class="modal fade" id="delete{{ $jadwals->id }}" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Data jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('Admin.manajemen-sampah.kelola-tugas.destroy', Crypt::encrypt($jadwals->id)) }}">
                    @csrf
                    @method('DELETE')
                    <h4 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h4>
                    <h5 class="text-center">Lokasi: {{ $jadwals->lokasi->tempat }} </h5>
                    <h5 class="text-center">Tanggal mulai penjemputan:  {{ date('H:i', strtotime($jadwals->mulai_penjemputan)) }} {{
                        date('d F Y', strtotime($jadwals->mulai_penjemputan)) }}</h5>
                    <h5 class="text-center">Tanggal selesai penjemputan: {{ date('H:i', strtotime($jadwals->selesai_penjemputan)) }} {{
                        date('d F Y', strtotime($jadwals->selesai_penjemputan)) }}
                    </h5>
                    <h5 class="text-class">Petugas : 
                    @foreach ( datajadwal($jadwals->id) as $petugass )
                    {{$petugass->petugas->name}}, 
                    @endforeach
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