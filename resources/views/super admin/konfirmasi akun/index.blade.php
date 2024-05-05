@extends('layouts.admin.index')

@section('main-content')
<div class="pagetitle">
    <h1>Konfirmasi Akun</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Konfirmasi akun</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kelola Akun Nasabah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">jabatan</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admin as $admins)
                            <tr>
                                <td>{{$admins->admin->name}}</td>
                                <td>{{$admins->username}}</td>
                                <td>{{$admins->role}}</td>
                                <td>{{$admins->admin->instansi}}</td>
                                <td>{{$admins->status}}</td>
                                <td><a href="#konfirmasi{{ $admins->id }}" data-bs-toggle="modal"
                                        class="btn btn-success"><i class="bi bi-check2"></i></a>
                                    <a href="#tolakkonfirmasi{{ $admins->id }}" data-bs-toggle="modal"
                                        class="btn btn-danger"><i class="bi bi-x-lg"></i></a>
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

@include('super admin.konfirmasi akun.modal')

@endsection