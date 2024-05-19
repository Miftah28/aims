@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-10">
        <div class="pagetitle">
            <h1>Penukaran Poin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Penukaran Poin</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col-2 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create"><i
                class="bi bi-arrow-left-right"></i> Tukar Poin</button>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Penukaran Poin</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nasabah</th>
                                <th class="text-center" scope="col">Kategori Sampah</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">Tempat Tukar</th>
                                <th class="text-center" scope="col">status</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penukaran as $penukarans)
                            <tr>
                                <td class="text-center">{{$penukarans->nasabah->name}}</td>
                                <td>
                                    Jenis Sampah : {{$penukarans->kategoriSampah->jenis_sampah}} <br>
                                    Berat Sampah : {{$penukarans->pemasukan_sampah}} KG <br>
                                    @php 
                                    $poins = ($penukarans->pemasukan_sampah * $penukarans->kategoriSampah->poin_sampah) / $penukarans->kategoriSampah->berat_sampah;
                                    $bagipoin = $poins / poinsampah($penukarans->kategoriSampah->id)->jumlah_poin;
                                    $dapetduit = $bagipoin * poinsampah($penukarans->kategoriSampah->id)->jumlah_saldo;
                                    @endphp
                                    Poin Bertambah : <span style="color: green">+ {{$poins}}</span>  <br>
                                    Total Poin : {{poinnasabah($penukarans->nasabah_id)->total}} <br>
                                    {{-- Dapat Uang : Rp. {{ number_format($dapetduit, 0, ',', '.') }} --}}
                                </td>
                                <td class="text-center">{{$penukarans->instansi}}</td>
                                <td class="text-center">Datang Ketempat Langsung</td>
                                <td class="text-center">
                                    <a href="#edit{{ $penukarans->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $penukarans->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="7">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.penukaran poin.modal')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var nasabahSelect = document.getElementById('nasabah_id');
        var totalPoinInput = document.getElementById('total_poin');

        nasabahSelect.addEventListener('change', function () {
            var nasabahId = nasabahSelect.value;
            if (nasabahId) {
                // Call the carinasabah function and update the total_poin input
                fetch(`/carinasabah/${nasabahId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            totalPoinInput.value = data.total;
                        } else {
                            totalPoinInput.value = 0;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching nasabah data:', error);
                        totalPoinInput.value = 0;
                    });
            } else {
                totalPoinInput.value = 0;
            }
        });
    });
</script>


@endsection