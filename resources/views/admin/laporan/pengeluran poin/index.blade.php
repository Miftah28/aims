@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-10">
        <div class="pagetitle">
            <h1>Laporan Tukar Poin Nasabah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                    <li class="breadcrumb-item active">Laporan Tukar Poin Nasabah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col-2 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create"><i
                class="bi bi-printer"></i> Cetak</button>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Tukar Poin Nasabah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nasabah</th>
                                <th class="text-center" scope="col">Petugas Penukaran</th>
                                <th class="text-center" scope="col">Tukar Poin</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengeluaran as $pengeluarans)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>Nama Nasabah : {{$pengeluarans->nasabah->name}} <br> Kode Pengguna :
                                    {{$pengeluarans->nasabah->kode_pengguna}}</td>
                                <td>
                                    @if ($pengeluarans->petugas_id != null)
                                    Admin : {{$pengeluarans->admin->name}} <br>
                                    Petugas : {{$pengeluarans->petugas->name}} <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($pengeluarans->tanggal)->format('d F Y H:i') }} <br>
                                    @else
                                    Admin : {{$pengeluarans->admin->name}} <br>
                                    Petugas : - <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($pengeluarans->tanggal)->format('d F Y H:i') }} <br>
                                    @endif
                                </td>
                                <td>
                                    Poin Berkurang : <span style="color: red">- {{$pengeluarans->kurang_poin}}</span>
                                    <br>
                                    Dapat Uang : Rp. {{ number_format( caripoin($pengeluarans->point_id)->jumlah_saldo,
                                    0, ',', '.') }}
                                </td>
                                <td class="text-center">{{$pengeluarans->admin->instansi}}</td>
                                <td>{{$pengeluarans->status}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">Data Tidak Ditemukan</td>
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

@endsection