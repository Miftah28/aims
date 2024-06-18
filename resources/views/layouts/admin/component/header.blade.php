<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ asset('storage/'.onepige()->logo) }}" alt="">
            <span class="d-none d-lg-block" style="color: #fff">CleanEarth</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            @if ( Auth::user()->role === 'superadmin')
            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">{{angkamintaverifikasi()}}</span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <div style="max-height: 300px; overflow-y: auto;">
                        <li class="dropdown-header">
                            Anda Memiliki {{angkamintaverifikasi()}} Permintaan verifikasi
                            <a href="{{route('SuperAdmin.konfirmasi-akun.index')}}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        @foreach ( datamintaverifikasi() as $admin )
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Permintaan konfirmasi dari {{$admin->admin->name}}</h4>
                                <p>dari instansi {{$admin->admin->instansi}}</p>
                                @php
                                    // Hitung perbedaan waktu dalam detik
                                    $diffInSeconds = $admin->created_at->diffInSeconds(now());

                                    // Inisialisasi variabel untuk menyimpan pesan waktu yang diformat
                                    $formattedTime = '';

                                    // Jika perbedaan waktu kurang dari 60 detik, gunakan detik
                                    if ($diffInSeconds < 60) {
                                        $formattedTime = $diffInSeconds . ' Detik Lalu';
                                    }
                                    // Jika perbedaan waktu kurang dari 1 jam, gunakan menit
                                    elseif ($diffInSeconds < 3600) {
                                        $diffInMinutes = floor($diffInSeconds / 60);
                                        $formattedTime = $diffInMinutes . ' Menit Lalu';
                                    }
                                    // Jika perbedaan waktu kurang dari 24 jam, gunakan jam
                                    elseif ($diffInSeconds < 86400) {
                                        $diffInHours = floor($diffInSeconds / 3600);
                                        $formattedTime = $diffInHours . ' Jam Lalu';
                                    }
                                    // Jika lebih dari 24 jam, gunakan hari
                                    else {
                                        $diffInDays = floor($diffInSeconds / 86400);
                                        $formattedTime = $diffInDays . ' Hari Lalu';
                                    }
                                @endphp
                                <p>{{$formattedTime}}</p>
                            </div>
                        </li>
                        @endforeach
                </div>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->
            @endif

            {{-- <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a><!-- End Messages Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have 3 new messages
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="assets/dashboard/img/messages-1.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Maria Hudson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="assets/dashboard/img/messages-2.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Anna Nelson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>6 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="assets/dashboard/img/messages-3.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>David Muldon</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>8 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="dropdown-footer">
                        <a href="#">Show all messages</a>
                    </li>

                </ul><!-- End Messages Dropdown Items -->

            </li><!-- End Messages Nav --> --}}

            <li class="nav-item dropdown pe-3">

                @php
                if (auth()->user()->role == 'superadmin') {
                $name = Auth::user()->superadmin->name;
                } elseif (auth()->user()->role == 'admin') {
                $name = Auth::user()->admin->name;
                }
                @endphp
                @php
                if (auth()->user()->role == 'superadmin') {
                $route = route('SuperAdmin.profile.index');
                } elseif (auth()->user()->role == 'admin') {
                $route = route('Admin.profile.index');
                }
                @endphp

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @php
                    $user = auth()->user();
                    $jabatan = $user->role;
                    $photo = null;

                    switch ($jabatan) {
                    case 'superadmin':
                    $photo = $user->superadmin->image;
                    break;
                    case 'admin':
                    $photo = $user->admin->image;
                    break;
                    }

                    $initial = $name[0];
                    @endphp

                    @if ($photo)
                    <img src="{{ asset('storage/' . $photo) }}" class="img-profile rounded-circle">
                    @else
                    <img src="{{ asset('images/preview.png') }}" class="rounded-circle" style="max-width: 100%;" />
                    @endif

                    <span class="d-none d-md-block dropdown-toggle ps-2">{{$name}}</span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{$name}}</h6>
                        {{-- <span>{{auth()->user()->jabatan}}</span> --}}
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @if($route)
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{$route}}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    @endif

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
