@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-lg-10">
        <div class="pagetitle">
            <h1>Pemasukan Sampah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pemasukan Sampah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col-lg-2 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create"><i
                class="bi bi-plus-lg"></i> Tambah</button>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body overflow-auto">
                    <h5 class="card-title">Pemasukan Sampah</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nasabah</th>
                                <th class="text-center" scope="col">Pemasukan Sampah</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">Tempat</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sampah as $sampahs)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                @php
                                // use Carbon\Carbon;
                                // $current_time = Carbon::now();
                                // $sampah_time = Carbon::parse($sampahs->tanggal);
                                // $diff_in_minutes = $current_time->diffInMinutes($sampah_time);
                                // Hitung perbedaan waktu dalam detik
                                    $diffInSeconds = $sampahs->created_at->diffInSeconds(now());
                                @endphp

                                @if($sampahs->status == 'datang langsung dengan nasabah')
                                    <td class="text-center">{{$sampahs->nasabah->name}}</td>
                                    <td>
                                        Jenis Sampah : {{$sampahs->kategoriSampah->jenis_sampah}} <br>
                                        Berat Sampah : {{$sampahs->pemasukan_sampah}} KG <br>
                                        Poin Bertambah : <span style="color: green">+
                                            {{$sampahs->kategoriSampah->poin_sampah * $sampahs->pemasukan_sampah}}</span>
                                        <br>
                                    </td>
                                    <td class="text-center">{{$sampahs->instansi}}</td>
                                    <td class="text-center">Datang Ketempat Langsung</td>
                                    @if ($diffInSeconds < 300)
                                    <td class="text-center">
                                        <a href="#edit{{ $sampahs->id }}" data-bs-toggle="modal" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                        <a href="#delete{{ $sampahs->id }}" data-bs-toggle="modal" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                    @else
                                        <td class="text-center">
                                            <button disabled class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                            <button disabled class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        </td>
                                    @endif
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

@include('admin.pemasukan sampah.modal')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
