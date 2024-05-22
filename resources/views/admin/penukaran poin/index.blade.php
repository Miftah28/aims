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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penukaran as $penukarans)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>Nama Nasabah : {{$penukarans->nasabah->name}} <br> Kode Pengguna : {{$penukarans->nasabah->kode_pengguna}}</td>
                                <td>
                                    {{-- Jenis Sampah : {{$penukarans->kategoriSampah->jenis_sampah}} <br> --}}
                                    {{-- @php 
                                    // $poins = ($penukarans->pemasukan_sampah * $penukarans->kategoriSampah->poin_sampah) / $penukarans->kategoriSampah->berat_sampah;
                                    $bagipoin = $penukarans->kurang_poin / poinsampah($penukarans->kategoriSampah->id)->jumlah_poin;
                                    $dapetduit = $bagipoin * poinsampah($penukarans->kategoriSampah->id)->jumlah_saldo;
                                    // $sisasaldo =  poinsampah($penukarans->kategoriSampah->id)->total - $penukarans->kurang_poin;
                                    @endphp --}}
                                    Poin Berkurang : <span style="color: red">- {{$penukarans->kurang_poin}}</span>  <br>
                                    {{-- Sisa Poin : {{$sisasaldo}} <br> --}}
                                    Dapat Uang : Rp. {{ number_format( caripoin($penukarans->point_id)->jumlah_saldo, 0, ',', '.') }}
                                </td>
                                <td class="text-center">{{$penukarans->admin->instansi}}</td>
                                <td class="text-center">Datang Ketempat Langsung</td>
                                <td>{{$penukarans->status}}</td>
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

@endsection