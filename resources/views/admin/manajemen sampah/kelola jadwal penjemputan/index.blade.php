@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-11">
        <div class="pagetitle">
            <h1>Kelola Jadwal Penjemputan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manajemen Sampah</li>
                    <li class="breadcrumb-item active">Kelola Jadwal Penjemputan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col-1">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create"><i
                class="bi bi-plus-lg"></i> Tambah</button>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kelola Jadwal Penjemputan</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Lokasi</th>
                                <th class="text-center" scope="col">Tanggal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $jadwals)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$jadwals->jenis_sampah}}</td>
                                <td class="text-center">{{$jadwals->berat_sampah}} KG</td>
                                <td class="text-center">{{$jadwals->poin_sampah}}</td>
                                <td class="text-center">
                                    <a href="#edit{{ $jadwals->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $jadwals->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">Data Tidak Ditemukan</td>
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

@include('admin.manajemen sampah.kelola jadwal penjemputan.modal')

@endsection