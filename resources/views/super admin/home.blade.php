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
            <div class="row">

                <!-- admin Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Admin <span>| Total</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-arms-up"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{countadmin()}}</h6>
                                    <span class="text-success small pt-1 fw-bold">{{countadminpersen()}}%</span> <span
                                        class="text-muted small pt-2 ps-1">Yang Masih Aktif</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End admin Card -->

                <!-- petugas Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Petugas <span>| Total</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-arms-up"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{countpetugas()}}</h6>
                                    <span class="text-success small pt-1 fw-bold">{{countpetugaspersen()}}%</span> <span
                                        class="text-muted small pt-2 ps-1">Yang Masih Aktif</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End petugas Card -->

                <!-- nasabah Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Nasabah <span>| Total</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-arms-up"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{countnasabah()}}</h6>
                                    <span class="text-success small pt-1 fw-bold">{{countnasabahpersen()}}%</span> <span
                                        class="text-muted small pt-2 ps-1">Yang Masih Aktif</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End nasabah Card -->

            </div>
        </div>
    </div>
</section>


@endsection