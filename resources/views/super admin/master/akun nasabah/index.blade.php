@extends('layouts.admin.index')

<style>
    #message {
        display: none;
    }

    #message p {
        font-size: 12px;
    }

    .valid {
        color: green;
    }

    .valid:before {
        content: "✔";
        font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;

    }

    .invalid {
        color: red;
    }

    .invalid:before {
        content: "✖";
        font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
    }
</style>

@section('main-content')
<div class="row justify-content-between">
    <div class="col-lg-11">
        <div class="pagetitle">
            <h1>Kelola Akun Nasabah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master</li>
                    <li class="breadcrumb-item active">Kelola Akun Nasabah</li>
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
                    <h5 class="card-title">Kelola Akun Nasabah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Id Pengguna</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">Alamat</th>
                                <th class="text-center" scope="col">No Telepon</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($akun as $akuns)
                            <tr>
                                <td>{{$akuns->name}}</td>
                                <td>{{$akuns->kode_pengguna}}</td>
                                <td>{{$akuns->user->username}}</td>
                                <td>{{$akuns->alamat}}</td>
                                <td>{{$akuns->no_hp}}</td>
                                <td><a href="#edit{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                    class="bi bi-pencil-square"></i></a>
                            <a href="#delete{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                    class="bi bi-trash"></i></a></td>
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

@include('super admin.master.akun nasabah.modal')
{{-- @include('super admin.master.akun.js') --}}

@endsection