@extends('layouts.admin.index')

@section('main-content')
<div class="row justify-content-between">
    <div class="col-11">
        <div class="pagetitle">
            <h1>Kelola Jadwal Penjemputan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manajemen Sampah</li>
                    <li class="breadcrumb-item active">Kelola Jadwal Penjemputan</li>
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
                    <h5 class="card-title">Kelola Jadwal Penjemputan</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Lokasi</th>
                                <th class="text-center" scope="col">Tanggal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $jadwals)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$jadwals->lokasi->tempat}}</td>
                                <td class="text-center">
                                    Mulai Penjemputan: {{ date('H:i', strtotime($jadwals->mulai_penjemputan)) }} {{
                                    date('d F Y', strtotime($jadwals->mulai_penjemputan)) }}
                                    <br>
                                    Selesai Penjemputan: {{ date('H:i', strtotime($jadwals->selesai_penjemputan)) }} {{
                                    date('d F Y', strtotime($jadwals->selesai_penjemputan)) }}
                                </td>
                                <td class="text-center">{{$jadwals->keterangan}}</td>
                                <td class="text-center">
                                    <a href="#edit{{ $jadwals->id }}" data-bs-toggle="modal" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#delete{{ $jadwals->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></a>
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

@include('admin.manajemen sampah.kelola jadwal penjemputan.modal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const mulaiPenjemputanInput = document.getElementById("mulai_penjemputan");
        const selesaiPenjemputanInput = document.getElementById("selesai_penjemputan");

        selesaiPenjemputanInput.addEventListener("change", function () {
            const mulaiPenjemputanValue = new Date(mulaiPenjemputanInput.value);
            const selesaiPenjemputanValue = new Date(selesaiPenjemputanInput.value);

            if (selesaiPenjemputanValue < mulaiPenjemputanValue) {
                alert("Selesai Penjemputan tidak boleh kurang dari Mulai Penjemputan");
                selesaiPenjemputanInput.value = ""; // Kosongkan input jika tidak valid
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(isset($jadwals))
            const mulaiPenjemputanInput = document.getElementById("mulai_penjemputanedit{{ $jadwals->id }}");
            const selesaiPenjemputanInput = document.getElementById("selesai_penjemputanedit{{ $jadwals->id }}");

            if (mulaiPenjemputanInput && selesaiPenjemputanInput) {
                selesaiPenjemputanInput.addEventListener("change", function () {
                    const mulaiPenjemputanValue = new Date(mulaiPenjemputanInput.value);
                    const selesaiPenjemputanValue = new Date(selesaiPenjemputanInput.value);

                    if (selesaiPenjemputanValue < mulaiPenjemputanValue) {
                        alert("Selesai Penjemputan tidak boleh kurang dari Mulai Penjemputan");
                        selesaiPenjemputanInput.value = ""; // Kosongkan input jika tidak valid
                    }
                });
            }
        @endif
    });
</script>

@endsection