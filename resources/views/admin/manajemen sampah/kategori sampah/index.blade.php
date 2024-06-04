@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-lg-11">
        <div class="pagetitle">
            <h1>Kelola Kategori Sampah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manajemen Sampah</li>
                    <li class="breadcrumb-item active">Kelola Kategori Sampah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col-lg-1">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create"><i
                class="bi bi-plus-lg"></i> Tambah</button>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body overflow-auto">
                    <h5 class="card-title">Kelola Kategori Sampah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Jenis Sampah</th>
                                <th class="text-center" scope="col">Berat Sampah</th>
                                <th class="text-center" scope="col">Poin Perberat Sampah</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategori as $kategoris)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$kategoris->jenis_sampah}}</td>
                                <td class="text-center">{{$kategoris->berat_sampah}} KG</td>
                                <td class="text-center">{{$kategoris->poin_sampah}}</td>
                                <td class="text-center">
                                    <a href="#edit{{ $kategoris->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $kategoris->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
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

@include('admin.manajemen sampah.kategori sampah.modal')

@endsection
