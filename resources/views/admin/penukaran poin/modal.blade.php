<!-- tamabah Pemasukan Sampah --->
<div class="modal fade" id="create" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penambahan Pemasukan Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Admin.penukaran-poin.tukar') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-6 mb-3">
                                <label for="nasabah_id" class="form-label"><span style="color: red;">*</span> Nasabah</label>
                                <select id="nasabah_id" class="selectpicker" data-live-search="true" data-width="100%" name="nasabah_id" required>
                                    <option value="">Pilih Nasabah (jika memiliki akun) </option>
                                    @forelse ($nasabah as $nasabahs)
                                    <option value="{{ $nasabahs->id }}">{{ $nasabahs->name }}</option>
                                    @empty
                                    <option value="NULL">Nasabah belum diinput</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="total_poin" class="form-label">Saldo Poin</label>
                                <input id="total_poin" type="number" class="form-control" name="total_poin" value="" disabled>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="poin_id" class="form-label"><span style="color: red;">*</span>
                                    Jenis Sampah</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%" name="poin_id"
                                    required>
                                    <option value="">Pilih Jenis Sampah </option>
                                    @forelse ($poin as $poins)
                                    <option value="{{ $poins->kategoriSampah->id }}">{{
                                        $poins->kategoriSampah->jenis_sampah }}</option>
                                    @empty
                                    <option value="NULL" disabled>Jenis Sampah belum diinput</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="kurang_poin" class="form-label"><span style="color: red;">*</span>
                                    Jumlah Poin yang di tukar</label>
                                <input id="kurang_poin" type="number" class="form-control" name="kurang_poin"
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