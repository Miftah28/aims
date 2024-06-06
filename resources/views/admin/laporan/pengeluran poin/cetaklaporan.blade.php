<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Keseluruhan Media</title>
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

    <p style="text-align: start; font-weight:bold">Data Perusahaan </p>
    <table class="table">
        <tbody>
            <tr>
                <td>Nama Perusahaan</td>
                <td>Nama Direktur</td>
                <td>Email Perusahaan</td>
                <td>Nomor Akta Pendirian</td>
                <td>Nomor Alamat Domisili</td>
                <td>Nomor NPWP Perusahaan</td>
                <td>Nomor Pengusaha Kena Pajak</td>
                <td>SPT Tahunan</td>
                <td>NIK KTP Direktur</td>
            </tr>
            {{-- @foreach ( $laporan as $laporans )
            <tr>
                <td>{{$laporans->nama_perusahaan}}</td>
                <td>{{$laporans->nama_direktur}}</td>
                <td>{{$laporans->email_perusahaan}}</td>
                <td>{{$laporans->nomer_akta_pendirian}}</td>
                <td>{{$laporans->alamat_domisili}}</td>
                <td>{{$laporans->npwp_perusahaan}}</td>
                <td>{{$laporans->nomer_pengusaha_kena_pajak}}</td>
                <td>{{$laporans->spt_tahunan}}</td>
                <td>{{$laporans->nik_ktp_direktur}}</td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>

</body>

</html>
