@extends('layouts.admin.index')
@section('main-content')
<div class="row justify-content-between">
    {{-- <div class="col-lg-10"> --}}
        <div class="pagetitle">
            <h1>Setting</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Setting</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        {{--
    </div> --}}
    {{-- <div class="col-lg-2 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create"><i
                class="bi bi-plus-lg"></i> Lihat Team</button>
    </div> --}}
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body overflow-auto">
                    <h5 class="card-title">Setting One Page</h5>
                    <form method="POST" action="{{ route('SuperAdmin.setting.update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="logo" class="form-label"><span style="color: red;">*</span> logo</label>
                                <div class="row">
                                    <div class="col-11">
                                        <input id="logo" type="file" class="form-control preview-image" name="logo"
                                            accept="image/*" >
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#lihat"><i class="bi bi-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="nama_aplikasi"> <span style="color: red;">*</span> Nama Aplikasi</label>
                                <input type="text" name="nama_aplikasi" id="nama_aplikasi" class="form-control"
                                    value="{{ $setting->nama_aplikasi }}" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="no_telp"> <span style="color: red;">*</span> No Telepon</label>
                                <input type="number" name="no_telp" id="no_telp" class="form-control"
                                    value="{{ $setting->no_telp }}" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="email"> <span style="color: red;">*</span> Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $setting->email }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat"> <span style="color: red;">*</span> Alamat</label>
                                <textarea type="text" name="alamat" id="alamat" class="form-control"
                                    value="{{$setting->alamat}}" required>{{ $setting->alamat }}</textarea>
                            </div>
                            <label for="deskripsi"> <span style="color: red;">*</span> Deskripsi Aplikasi</label>
                            <div id="quill-editor" class="quill-editor-full mb-3">{!! $setting->deskripsi !!}</div>
                            <input type="hidden" name="deskripsi" id="deskripsi" value="{{ $setting->deskripsi }}"
                                required>
                            <div class="col-12 mb-3 text-end">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Kelola Team</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th class="text-center" scope="col">Nama Lengkap</th>
                                        <th class="text-center" scope="col">Jabatan</th>
                                        <th class="text-center" scope="col">Deskripsi</th>
                                        <th class="text-center" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($team as $teams)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{$teams->nama}}</td>
                                        <td class="text-center">{{$teams->jabatan}}</td>
                                        <td class="text-center">{{ limit_sentences($teams->deskripsi, 8) }}</td>
                                        <td class="text-center">
                                            <a href="#lihatfoto{{ $teams->id }}" data-bs-toggle="modal"
                                                class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                            <a href="#edit{{ $teams->id }}" data-bs-toggle="modal"
                                                class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                            <a href="#delete{{ $teams->id }}" data-bs-toggle="modal"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body overflow-auto">
                        <h5 class="card-title">Tambah Team</h5>
                        <form method="POST" action="{{ route('SuperAdmin.setting.create-team') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="foto" class="form-label"><span style="color: red;">*</span> Foto</label>
                                    <input id="foto" type="file" class="form-control preview-image" name="foto"
                                        accept="image/*" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="nama" class="form-label"><span style="color: red;">*</span>
                                        Nama Lengkap</label>
                                    <input id="nama" type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="jabatan" class="form-label"><span style="color: red;">*</span>
                                        Jabatan</label>
                                    <input id="jabatan" type="text" class="form-control" name="jabatan" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="deskripsi" class="form-label"><span style="color: red;">*</span>
                                        Deskripsi</label>
                                    <textarea id="deskripsi" type="text" class="form-control" name="deskripsi"
                                        required></textarea>
                                </div>
                                <div class="col-12 mb-3 text-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('super admin.setting.modal')
@endsection
