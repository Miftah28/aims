<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Pemasukan Sampah</title>
    <style>
        @page {
            size: F4 landscape;
            /* Ukuran F4 dengan orientasi landscape */
            margin: 1cm;
            /* Set margin sesuai kebutuhan Anda */
        }

        body {
            text-align: start;
        }

        /* Gaya untuk tabel */
        .table-container {
            overflow: auto;
        }

        table {
            font-family: "Times New Roman", Times, serif;
            font-size: 9px;
            border-collapse: collapse;
            width: 100%;
            /* Lebar tabel 100% */
            table-layout: fixed;
            /* Tambahkan ini untuk memastikan tabel tidak melebihi lebar maksimum */
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        td {
            word-wrap: break-word;
            /* Jika teks terlalu panjang, teks akan pindah ke bawah */
            page-break-inside: auto;
            /* Izinkan pemisahan halaman dalam sel jika melebihi batas halaman */
        }

        /* Gaya untuk judul kolom */
        th {
            background-color: #f2f2f2;
        }

        /* Gaya untuk baris ganjil */
        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        /* Gaya untuk baris genap */
        tr:nth-child(even) {
            background-color: #ffffff;
        }

        /* Style for image container */
        .image-container {
            text-align: center;
            margin-top: 20px;
            page-break-before: always;
            /* Force page break before each image */
        }

        .image-container img {
            width: auto%;
            /* Ensure images don't exceed their container */
            max-height: 80%;
            /* Maintain aspect ratio */
            margin-top: 10px;
            /* Add some spacing between images */
        }
    </style>
</head>

<body>

    <p style="text-align: start; font-weight:bold">Data Tukar Poin Nasabah </p>
    <table class="table">
        <tbody>
            <tr>
                <th scope="col">No</th>
                <th class="text-center" scope="col">Nasabah</th>
                <th class="text-center" scope="col">Petugas</th>
                <th class="text-center" scope="col">Tukar Poin</th>
                <th class="text-center" scope="col">Instansi</th>
                <th class="text-center" scope="col">status</th>
            </tr>
            </thead>
        <tbody>
            @forelse ($laporan as $laporans)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>Nama Nasabah : {{$laporans->nasabah->name}} <br> Kode Pengguna :
                    {{$laporans->nasabah->kode_pengguna}}</td>
                <td>
                    @if ($laporans->petugas_id != null)
                    Admin : {{$laporans->admin->name}} <br>
                    Petugas : {{$laporans->petugas->name}} <br>
                    Tanggal: {{ \Carbon\Carbon::parse($laporans->tanggal)->format('d F Y H:i') }} <br>
                    Tempat:<a
                        href="https://www.google.com/maps/search/?api=1&query={{ $laporans->sampah->lokasi->koordinat }}"
                        target="_blank">
                        {{ $laporans->sampah->lokasi->tempat }}
                    </a> <br>
                    @else
                    Admin : {{$laporans->admin->name}} <br>
                    Petugas : - <br>
                    Tanggal: {{ \Carbon\Carbon::parse($laporans->tanggal)->format('d F Y H:i') }} <br>
                    Tempat : Datang langsung ke lokasi
                    @endif
                </td>
                <td>
                    Jenis Sampah : {{$laporans->sampah->kategoriSampah->jenis_sampah}} <br>
                    Berat Sampah : {{$laporans->sampah->pemasukan_sampah}} KG <br>
                    Poin Bertambah : <span style="color: green">+
                        {{$laporans->sampah->kategoriSampah->poin_sampah *
                        $laporans->sampah->pemasukan_sampah}}</span>
                    <br>
                </td>
                <td class="text-center">{{$laporans->admin->instansi}}</td>
                <td>{{$laporans->status}}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="6">Data Tidak Ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
