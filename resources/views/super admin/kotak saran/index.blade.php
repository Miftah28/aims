@extends('layouts.admin.index')
@section('main-content')
<div class="col-lg-12">
    <div class="pagetitle">
        <h1>Kotak Saran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Kotak Saran</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body overflow-auto">
                    <h5 class="card-title">Kotak Saran</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nama Lengkap</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">Saran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($saran as $sarans)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$sarans->nama}}</td>
                                <td class="text-center">{{$sarans->email}} KG</td>
                                <td class="text-center">{{$sarans->saran}}</td>
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
@endsection
