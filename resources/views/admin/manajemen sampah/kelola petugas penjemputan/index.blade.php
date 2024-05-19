@extends('layouts.admin.index')

@section('main-content')
<div class="pagetitle">
    <h1>Kelola Petugas Penjemputan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Sampah</li>
            <li class="breadcrumb-item active">Kelola Petugas Penjemputan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kelola Petugas Penjemputan</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Lokasi</th>
                                <th class="text-center" scope="col">Tanggal</th>
                                <th class="text-center" scope="col">Petugas</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $jadwals)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$jadwals->lokasi->tempat}}</td>
                                <td class="text-center">
                                    Mulai Penjemputan: {{ date('H:i', strtotime($jadwals->mulai_penjemputan)) }} {{
                                    date('d F Y', strtotime($jadwals->mulai_penjemputan)) }}
                                    <br>
                                    Selesai Penjemputan: {{ date('H:i', strtotime($jadwals->selesai_penjemputan)) }} {{
                                    date('d F Y', strtotime($jadwals->selesai_penjemputan)) }}
                                </td>

                                <td>
                                    @forelse (datajadwal($jadwals->id) as $item )
                                    - {{$item->petugas->name}}<br>
                                    @empty
                                    -
                                    @endforelse
                                </td>

                                <td class="text-center">{{$jadwals->keterangan}}</td>

                                @if (datajadwal($jadwals->id)->isNotEmpty())
                                <td class="text-center">
                                    <a href="#edit{{ $jadwals->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $jadwals->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                                @else
                                <td class="text-center"><a href="#create{{ $jadwals->id }}" data-bs-toggle="modal"
                                        class="btn btn-primary"><i class="bi bi-plus-lg"></i></a></td>
                                @endif




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

@include('admin.manajemen sampah.kelola petugas penjemputan.modal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection