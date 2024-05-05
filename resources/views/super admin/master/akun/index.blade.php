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
    <div class="col-11">
        <div class="pagetitle">
            <h1>Kelola Akun</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master</li>
                    <li class="breadcrumb-item active">Kelola Akun</li>
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
                    <h5 class="card-title">Kelola Akun</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Jabatan</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($akun as $akuns)
                            <tr>
                                @if ($akuns->role == 'superadmin')
                                <td>{{$akuns->superadmin->name}}</td>
                                <td>{{$akuns->role}}</td>
                                <td class="text-center">-</td>
                                @if ($akuns->id == Auth::user()->superadmin->user_id)
                                <td class="text-center"><a @disabled(true)><span class="badge bg-success"><i
                                                class="bi bi-check-circle me-1"></i>
                                            Aktif</span></a></td>
                                <td class="text-center"><button disabled class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button disabled class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                                @else
                                @if ($akuns->status == 'aktif')
                                <td class="text-center">
                                    <a
                                        href="{{route('SuperAdmin.master.akun.unverifikasistatus', Crypt::encrypt($akuns->id))}}"><span
                                            class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                            Aktif</span></a>
                                </td>
                                <td class="text-center">
                                    <a href="#edit{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                                @elseif($akuns->status == 'tidak aktif')
                                <td class="text-center">
                                    <a
                                        href="{{route('SuperAdmin.master.akun.verifikasistatus', Crypt::encrypt($akuns->id))}}"><span
                                            class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                            Tidak Aktif</span></a>
                                </td>
                                <td class="text-center">
                                    <a href="#edit{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                                @endif
                                @endif

                                @elseif($akuns->role == 'admin')
                                <td>{{$akuns->admin->name}}</td>
                                <td>{{$akuns->role}}</td>
                                <td>{{$akuns->admin->instansi}}</td>
                                @if ($akuns->status == 'aktif')
                                <td class="text-center">
                                    <a
                                        href="{{route('SuperAdmin.master.akun.unverifikasistatus', Crypt::encrypt($akuns->id))}}"><span
                                            class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                            Aktif</span></a>
                                </td>
                                <td class="text-center">
                                    <a href="#tambahpetugas{{ $akuns->id }}" data-bs-toggle="modal"
                                        class="btn btn-primary"><i class="bi bi-plus-lg"></i></a>
                                    <a href="#edit{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                                @elseif($akuns->status == 'prosess')
                                <td class="text-center">
                                    <a @disabled(true)><span class="badge bg-warning"><i class="bi bi-info-lg"></i>
                                            Prosess</span></a>
                                </td>
                                <td class="text-center">
                                    <button disabled class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
                                    <button disabled class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button disabled class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                                @elseif($akuns->status == 'tidak diterima')
                                <td class="text-center">
                                    <a @disabled(true)><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                            Ditolak</span></a>
                                </td>
                                <td class="text-center">
                                    <button disabled class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
                                    <button disabled class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button disabled class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                                @elseif($akuns->status == 'tidak aktif')
                                <td class="text-center">
                                    <a
                                        href="{{route('SuperAdmin.master.akun.verifikasistatus', Crypt::encrypt($akuns->id))}}"><span
                                            class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                            Tidak Aktif</span></a>
                                </td>
                                <td class="text-center">
                                    <a href="#tambahpetugas{{ $akuns->id }}" data-bs-toggle="modal"
                                        class="btn btn-primary"><i class="bi bi-plus-lg"></i></a>
                                    <a href="#edit{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $akuns->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                                @endif

                                @foreach (datapetugas($akuns->admin->id) as $petugas)
                                @if($petugas->user->role == 'petugas')
                            <tr>
                                <td style="padding-left:30px ">{{$petugas->name}}</td>
                                <td style="padding-left:30px ">{{$petugas->user->role}} {{$petugas->admin->instansi}}
                                </td>
                                <td style="padding-left:30px ">{{$petugas->admin->instansi}}</td>
                                @if ($petugas->user->status == 'aktif')
                                <td style="padding-left:30px " class="text-center">
                                    <a
                                        href="{{route('SuperAdmin.master.akun.unverifikasistatus', Crypt::encrypt($petugas->user->id))}}"><span
                                            class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                            Aktif</span></a>
                                </td>
                                @elseif($petugas->user->status == 'tidak aktif')
                                <td style="padding-left:30px " class="text-center">
                                    <a
                                        href="{{route('SuperAdmin.master.akun.verifikasistatus', Crypt::encrypt($petugas->user->id))}}"><span
                                            class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                            Tidak Aktif</span></a>
                                </td>
                                @endif
                                <td class="text-center">
                                    <a href="#editpetugas{{ $petugas->id }}" data-bs-toggle="modal"
                                        class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <a href="#deletepetugas{{ $petugas->id }}" data-bs-toggle="modal"
                                        class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
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

@include('super admin.master.akun.modal')
@include('super admin.master.akun.js')

@endsection