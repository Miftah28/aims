<!-- tamabah Kategori Sampah --->
<div class="modal fade" id="print" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cetak Laporan Tukar Poin Nasabah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Admin.laporan.penukaran-poin.cetak', Crypt::encrypt(Auth::user()->admin->id)) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="tanggalawal" class="form-label">
                                    Tanggal Awal</label>
                                <input id="tanggalawal" type="date" class="form-control" name="tanggalawal">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="tanggalakhir" class="form-label">
                                    Tanggal Akhir</label>
                                <input id="tanggalakhir" type="date" class="form-control" name="tanggalakhir">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="role" class="form-label">Jabatan</label>
                                <select id="role" class="selectpicker" data-live-search="true" data-width="100%" name="role">
                                    <option value="">Pilih Jabatan </option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3" id="petugas-container">
                                <label for="petugas" class="form-label">Petugas</label>
                                <select id="petugas" class="selectpicker" multiple data-live-search="true" data-width="100%" name="petugas[]">
                                    <option value="">Pilih Petugas </option>
                                    @forelse ($petugas as $petugass)
                                    <option value="{{$petugass->id}}">{{$petugass->name}} </option>
                                    @empty
                                    <option value="">Pilih Petugas </option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Cetak</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div><!-- End Create Modal-->
