@extends('layouts.admin.index')

@section('main-content')

{{-- @include('admin.manajemen sampah.kelola tempat penjemputan.css') --}}
<div class="row justify-content-between">
    <div class="col-11">
        <div class="pagetitle">
            <h1>Kelola Tempat Penjemputan Sampah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manajemen Sampah</li>
                    <li class="breadcrumb-item active">Kelola Tempat Penjemputan Sampah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col-1">
        <a type="button" class="btn btn-primary" href="{{route('Admin.manajemen-sampah.kelola-tempat.create')}}"><i
                class="bi bi-plus-lg"></i> Tambah</a>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kelola Tempat Penjemputan Sampah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Alamat Tempat</th>
                                <th class="text-center" scope="col">Koordinat</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tempat as $tempats)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td class="text-center">{{$tempats->tempat}}</td>
                                <td class="text-center">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $tempats->koordinat }}"
                                        target="_blank">
                                        {{ $tempats->koordinat }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('Admin.manajemen-sampah.kelola-tempat.edit',Crypt::encrypt($tempats->id))}}" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $tempats->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="4">Data Tidak Ditemukan</td>
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

@include('admin.manajemen sampah.kelola tempat penjemputan.modal')
{{-- @include('admin.manajemen sampah.kelola tempat penjemputan.js') --}}
@endsection