@extends('layouts.admin.index')
@section('main-content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>

        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row ">
                <!-- pemasukan sampah Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="col-xxl-12 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body overflow-auto">
                                <h5 class="card-title">Pemasukan Sampah <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-recycle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{countpemasukansampah()}} Kg</h6>
                                        <span class="text-success small pt-1 fw-bold">{{countpemasukansampah()}}
                                            KG</span>
                                        <span class="text-muted small pt-2 ps-1">Pada Tahun {{ date('Y')}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-12 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body overflow-auto">
                                <h5 class="card-title">Petugas <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-arms-up"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{countpetugasadmin()}}</h6>
                                        <span
                                            class="text-success small pt-1 fw-bold">{{countpetugaspersenadmin()}}%</span>
                                        <span class="text-muted small pt-2 ps-1">Yang Masih Aktif</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End petugas Card -->
                </div><!-- End pemasukan sampah Card -->

                <!-- petugas Card -->


                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Petugas Mendapatkan Pemasukan Sampah Terhbanyak Pada Tahun {{
                                date('Y')}}</h5>

                            <!-- Bar Chart -->
                            <div id="petugas-sampah"></div>


                            <!-- End Bar Chart -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan Sampah Perkategori Sampah Tahun {{ date('Y')}}</h5>

                            <!-- Kategori Sampah -->
                            <div id="pieChart"></div>

                            <!-- End Kategori Sampah -->

                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan Sampah Perbulan Pada Tahun {{ date('Y')}}</h5>

                            <!-- Line Chart -->
                            <div id="lineChart"></div>

                            <!-- End Line Chart -->

                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lokasi Penyumbang Sampah Pada Tahun {{ date('Y')}}</h5>

                            <!-- Bar Chart -->
                            <div id="lokasi"></div>

                            <!-- End Bar Chart -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@include('admin.js')

@endsection
