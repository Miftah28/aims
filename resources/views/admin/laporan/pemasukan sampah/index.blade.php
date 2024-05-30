@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-10">
        <div class="pagetitle">
            <h1>Laporan Pemasukan Sampah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                    <li class="breadcrumb-item active">Laporan Pemasukan Sampah</li>
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
                    <h5 class="card-title">Laporan Pemasukan Sampah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nasabah</th>
                                <th class="text-center" scope="col">Petugas</th>
                                <th class="text-center" scope="col">Tukar Poin</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pemasukan as $pemasukans)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>Nama Nasabah : {{$pemasukans->nasabah->name}} <br> Kode Pengguna :
                                    {{$pemasukans->nasabah->kode_pengguna}}</td>
                                <td>
                                    @if ($pemasukans->petugas_id != null)
                                    Admin : {{$pemasukans->admin->name}} <br>
                                    Petugas : {{$pemasukans->petugas->name}} <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($pemasukans->tanggal)->format('d F Y H:i') }} <br>
                                    Tempat:<a
                                        href="https://www.google.com/maps/search/?api=1&query={{ $pemasukans->sampah->lokasi->koordinat }}"
                                        target="_blank">
                                        {{ $pemasukans->sampah->lokasi->tempat }}
                                    </a> <br>
                                    @else
                                    Admin : {{$pemasukans->admin->name}} <br>
                                    Petugas : - <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($pemasukans->tanggal)->format('d F Y H:i') }} <br>
                                    Tempat : Datang langsung ke lokasi
                                    @endif
                                </td>
                                <td>
                                    Jenis Sampah : {{$pemasukans->sampah->kategoriSampah->jenis_sampah}} <br>
                                    Berat Sampah : {{$pemasukans->sampah->pemasukan_sampah}} KG <br>
                                    Poin Bertambah : <span style="color: green">+
                                        {{$pemasukans->sampah->kategoriSampah->poin_sampah *
                                        $pemasukans->sampah->pemasukan_sampah}}</span>
                                    <br>
                                </td>
                                <td class="text-center">{{$pemasukans->admin->instansi}}</td>
                                <td>{{$pemasukans->status}}</td>
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