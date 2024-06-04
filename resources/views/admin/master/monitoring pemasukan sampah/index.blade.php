@extends('layouts.admin.index')

@section('main-content')

<div class="pagetitle">
    <h1>Monitoring Pemasukan Sampah</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Master</li>
            <li class="breadcrumb-item active">Monitoring Pemasukan Sampah</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body overflow-auto">
                    <h5 class="card-title">Monitoring Pemasukan Sampah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Petugas</th>
                                <th class="text-center" scope="col">Kategori Sampah</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">Tempat Tukar</th>
                                <th class="text-center" scope="col">Pemasukan Sampah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pemasukan as $pemasukans)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$pemasukans->petugas->name}}</td>
                                <td>{{$pemasukans->kategoriSampah->jenis_sampah}}</td>
                                <td>{{$pemasukans->petugas->admin->instansi}}</td>
                                <td> <a href="https://www.google.com/maps/search/?api=1&query={{ $pemasukans->lokasi->koordinat }}"
                                        target="_blank">
                                        {{ $pemasukans->lokasi->tempat }}
                                    </a></td>
                                <td>{{$pemasukans->pemasukan_sampah}} KG</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="7">Data Tidak Ditemukan</td>
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
