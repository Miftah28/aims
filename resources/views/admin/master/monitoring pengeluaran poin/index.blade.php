@extends('layouts.admin.index')

@section('main-content')

<div class="pagetitle">
    <h1>Monitoring Pengeluaran Poin</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Master</li>
            <li class="breadcrumb-item active">Monitoring Pengeluaran Poin</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Monitoring Pengeluaran Poin</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Petugas</th>
                                <th class="text-center" scope="col">Nasabah</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">Tukar Poin</th>
                                <th class="text-center" scope="col">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengeluaran as $pengeluarans)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$pengeluarans->petugas->name}}</td>
                                <td>{{$pengeluarans->nasabah->name}}, kode pengguna: {{$pengeluarans->nasabah->kode_pengguna}}</td>
                                <td>{{$pengeluarans->petugas->admin->instansi}}</td>
                                <td>
                                    Poin Berkurang : <span style="color: red">- {{$pengeluarans->kurang_poin}}</span>  <br>
                                    Dapat Uang : Rp. {{ number_format( caripoin($pengeluarans->point_id)->jumlah_saldo, 0, ',', '.') }}
                                </td>
                                <td>{{$pengeluarans->status}}</td>
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