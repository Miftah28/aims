@extends('layouts.admin.index')

@section('main-content')

@include('admin.manajemen sampah.kelola tempat penjemputan.css')

<div class="pagetitle">
    <h1>Tambah Data Tempat Penjemputan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Sampah</li>
            <li class="breadcrumb-item active">Kelola Tempat Penjemputan</li>
            <li class="breadcrumb-item active">Tambah Data Tempat Penjemputan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Data Tempat Penjemputan</h5>

                    <!-- Browser Default Validation -->
                    <form class="row g-3" method="POST"
                        action="{{ route('Admin.manajemen-sampah.kelola-tempat.store') }}"
                        enctype="multipart/form-data">
                        {{-- {{ csrf_field() }} --}}
                        @csrf
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-8 mb-3">
                                    <div id="map"></div>
                                </div>
                                <div class="col-4 mb-3">
                                    <div class="container">
                                        <div class="row justify-content-start">

                                            <div class="col-12 mb-3">
                                                <label for="tempat" class="form-label"><span
                                                        style="color: red;">*</span>
                                                    Alamat</label>
                                                <textarea id="tempat" type="text" class="form-control" name="tempat"
                                                    required></textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="koordinat" class="form-label"><span
                                                        style="color: red;">*</span>
                                                    Koordinat</label>
                                                <input id="koordinat" type="text" class="form-control" name="koordinat"
                                                    required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="longitude" class="form-label"><span
                                                        style="color: red;">*</span>
                                                    Longitude</label>
                                                <input id="longitude" type="text" class="form-control"
                                                    name="longitude" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="latitude" class="form-label"><span
                                                        style="color: red;">*</span>
                                                    Latitude</label>
                                                <input id="latitude" type="text" class="form-control" name="latitude"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-2 text-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End Browser Default Validation -->

                </div>
            </div>

        </div>
    </div>
</section>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var Stadia_Dark = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

        var Esri_WorldStreetMap = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
            });

        var map = L.map('map', {
            center: [-5.129541583080711, 113.62957770241515],
            zoom: 5,
            layers: [osm]
        });

        var marker = L.marker([-5.129541583080711, 113.62957770241515], {
            draggable: true
        }).addTo(map);

        var baseMaps = {
            'Open Street Map': osm,
            'Esri World': Esri_WorldStreetMap,
            'Stadia Dark': Stadia_Dark
        };

        L.control.layers(baseMaps).addTo(map);

        // CARA PERTAMA
        function onMapClick(e) {
            var coords = document.querySelector("[name=koordinat]");
            var latitude = document.querySelector("[name=latitude]");
            var longitude = document.querySelector("[name=longitude]");
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }

            coords.value = lat + "," + lng;
            latitude.value = lat;
            longitude.value = lng;
        }
        map.on('click', onMapClick);
        // CARA PERTAMA

        // CARA KEDUA
        marker.on('dragend', function() {
            var koordinat = marker.getLatLng();
            marker.setLatLng(koordinat, {
                draggable: true
            });
            $('#koordinat').val(koordinat.lat + "," + koordinat.lng).keyup();
            $('#latitude').val(koordinat.lat).keyup();
            $('#longitude').val(koordinat.lng).keyup();
        });
        // CARA KEDUA
    });
</script>

@endsection