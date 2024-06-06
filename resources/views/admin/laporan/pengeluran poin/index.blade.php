@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-lg-10">
        <div class="pagetitle">
            <h1>Laporan Tukar Poin Nasabah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                    <li class="breadcrumb-item active">Laporan Tukar Poin Nasabah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col-lg-2 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#print"><i
                class="bi bi-printer"></i> Cetak</button>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body overflow-auto">
                    <form method="POST" action="{{route('laporan.poin.filter')}}" style="display:inline;">
                        @csrf
                        <div class="row justify-content-between">
                            <div class="col-3">
                                <h5 class="card-title">Laporan Tukar Poin Nasabah</h5>
                            </div>
                            <div class="col-2 mt-3 ">
                                <input type="date" class="form-control" name="filterdateawal"
                                    value="{{session('datefrom')}}" required>
                            </div>
                            <div class="col-2 mt-3">
                                <input type="date" class="form-control" name="filterdateakhir"
                                    value="{{session('dateto')}}" required>
                            </div>
                            <div class="col-5 mt-3">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-filter"></i>
                                    Filter</button>
                            </div>
                        </div>
                    </form>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nasabah</th>
                                <th class="text-center" scope="col">Petugas Penukaran</th>
                                <th class="text-center" scope="col">Tukar Poin</th>
                                <th class="text-center" scope="col">Instansi</th>
                                <th class="text-center" scope="col">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(empty(session('filtering')))
                            @forelse ($pengeluaran as $pengeluarans)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>Nama Nasabah : {{$pengeluarans->nasabah->name}} <br> Kode Pengguna :
                                    {{$pengeluarans->nasabah->kode_pengguna}}</td>
                                <td>
                                    @if ($pengeluarans->petugas_id != null)
                                    Admin : {{$pengeluarans->admin->name}} <br>
                                    Petugas : {{$pengeluarans->petugas->name}} <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($pengeluarans->tanggal)->format('d F Y H:i') }}
                                    <br>
                                    @else
                                    Admin : {{$pengeluarans->admin->name}} <br>
                                    Petugas : - <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($pengeluarans->tanggal)->format('d F Y H:i') }}
                                    <br>
                                    @endif
                                </td>
                                <td>
                                    Poin Berkurang : <span style="color: red">- {{$pengeluarans->kurang_poin}}</span>
                                    <br>
                                    Dapat Uang : Rp. {{ number_format( caripoin($pengeluarans->point_id)->jumlah_saldo,
                                    0, ',', '.') }}
                                </td>
                                <td class="text-center">{{$pengeluarans->admin->instansi}}</td>
                                <td>{{$pengeluarans->status}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                            @else
                            @forelse (session('filtering') as $filter)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>Nama Nasabah : {{$filter->nasabah->name}} <br> Kode Pengguna :
                                    {{$filter->nasabah->kode_pengguna}}</td>
                                <td>
                                    @if ($filter->petugas_id != null)
                                    Admin : {{$filter->admin->name}} <br>
                                    Petugas : {{$filter->petugas->name}} <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($filter->tanggal)->format('d F Y H:i') }}
                                    <br>
                                    @else
                                    Admin : {{$filter->admin->name}} <br>
                                    Petugas : - <br>
                                    Tanggal: {{ \Carbon\Carbon::parse($filter->tanggal)->format('d F Y H:i') }}
                                    <br>
                                    @endif
                                </td>
                                <td>
                                    Poin Berkurang : <span style="color: red">- {{$filter->kurang_poin}}</span>
                                    <br>
                                    Dapat Uang : Rp. {{ number_format( caripoin($filter->point_id)->jumlah_saldo,
                                    0, ',', '.') }}
                                </td>
                                <td class="text-center">{{$filter->admin->instansi}}</td>
                                <td>{{$filter->status}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                            @endif
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>
@include('admin.laporan.pengeluran poin.modal')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var roleSelect = document.getElementById('role');
        var petugasContainer = document.getElementById('petugas-container');

        // Initially hide the petugas container
        petugasContainer.style.display = 'none';

        roleSelect.addEventListener('change', function() {
            if (roleSelect.value === 'petugas') {
                petugasContainer.style.display = 'block';
            } else {
                petugasContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection
