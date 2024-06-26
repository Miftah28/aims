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
                            <div class="col-6 mb-3">
                                <label for="jumlah_poin" class="form-label"><span style="color: red;">*</span> Jumlah
                                    Poin</label>
                                <input id="jumlah_poin" type="number" class="form-control" name="jumlah_poin" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="jumlah_saldo" class="form-label"><span style="color: red;">*</span> Jumlah
                                    Saldo</label>
                                <input id="jumlah_saldo" type="text" class="form-control" name="jumlah_saldo" required
                                    readonly>
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
<script>
    document.getElementById('jumlah_poin').addEventListener('input', function() {
        var jumlahPoin = this.value;
        var formattedRupiah = formatRupiah(jumlahPoin);
        document.getElementById('jumlah_saldo').value = formattedRupiah;
    });

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }
</script>

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
                            <div class="col-6 mb-3">
                                <label for="jumlah_poin" class="form-label"><span style="color: red;">*</span> Jumlah
                                    Poin</label>
                                <input id="jumlah_poin{{$poins->id}}" type="number" class="form-control"
                                    name="jumlah_poin" value="{{ $poins->jumlah_poin }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="jumlah_saldo" class="form-label"><span style="color: red;">*</span> Jumlah
                                    Saldo</label>
                                <input id="jumlah_saldo{{$poins->id}}" type="text" class="form-control"
                                    name="jumlah_saldo" value="{{ $poins->jumlah_saldo }}" readonly>
                            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var poinInput = document.getElementById('jumlah_poin{{ $poins->id }}');
        var saldoInput = document.getElementById('jumlah_saldo{{ $poins->id }}');

        // Format saldo when the page loads
        var initialJumlahPoin = poinInput.value;
        if (initialJumlahPoin) {
            saldoInput.value = formatRupiah(initialJumlahPoin);
        }

        // Update saldo when the poin input changes
        poinInput.addEventListener('input', function() {
            var jumlahPoin = this.value;
            saldoInput.value = formatRupiah(jumlahPoin);
        });

        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }
    });
</script>

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
