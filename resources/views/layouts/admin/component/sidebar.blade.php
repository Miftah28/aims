<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        {{-- Super Admin --}}
        @if (auth()->user()->role == 'superadmin')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End dashboard  -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/master/*') ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-card-list"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content {{ request()->is('superadmin/master/*') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('superadmin/master/akun') ? 'active' : 'collapsed' }}"
                        href="{{ route('SuperAdmin.master.akun.index') }}">
                        <i class="bi bi-circle"></i><span>Akun</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('superadmin/master/akun-nasabah') ? 'active' : 'collapsed' }}"
                        href="{{ route('SuperAdmin.master.akun-nasabah.index-nasabah') }}">
                        <i class="bi bi-circle"></i><span>Akun Nasabah</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Master -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/konfirmasi-akun') ? 'active' : 'collapsed' }}"
                href="{{route('SuperAdmin.konfirmasi-akun.index')}}">
                <i class="bi bi-person-exclamation"></i><span>Konfrimasi Akun</span>
            </a>
        </li><!-- End konfirmasi Akun -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/setting') ? 'active' : 'collapsed' }}"
                href="{{route('SuperAdmin.setting.index')}}">
                <i class="bi bi-gear-fill"></i><span>Setting</span>
            </a>
        </li><!-- Setting -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/kotak-saran') ? 'active' : 'collapsed' }}"
                href="{{route('SuperAdmin.Kotak-Saran.index')}}">
                <i class="bi bi-envelope-paper"></i><span>Kotak Saran</span>
            </a>
        </li><!-- Setting -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/profile') ? 'active' : 'collapsed' }}"
                href="{{route('SuperAdmin.profile.index')}}">
                <i class="bi bi-person-circle"></i><span>Profile</span>
            </a>
        </li><!-- End Profile -->

        {{-- admin --}}
        @elseif (auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/penukaran-poin') ? '' : 'collapsed' }}" href="{{ route('Admin.penukaran-poin.index') }}">
                <i class="bi bi-arrow-down-up"></i>
                <span>Penukaran poin</span>
            </a>
        </li><!-- End penukaaran poin Nav -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/pemasukan-sampah') ? '' : 'collapsed' }}" href="{{ route('Admin.pemasukan-sampah.index') }}">
                <i class="bi bi-box-arrow-in-down"></i>
                <span>Pemasukan Sampah</span>
            </a>
        </li><!-- End Pemasukan Sampah poin Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/master/*') ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-card-list"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content {{ request()->is('admin/master/*') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/master/akun-petugas') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.master.akun-petugas.index') }}">
                        <i class="bi bi-circle"></i><span>Akun Petugas</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/master/pemasukan-sampah') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.master.pemasukan-sampah.index') }}">
                        <i class="bi bi-circle"></i><span>Monitoring Pemasukan Sampah</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/master/pemasukan-pengeluaran-poin') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.master.pemasukan-pengeluaran-poin.index') }}">
                        <i class="bi bi-circle"></i><span>Monitoring Pengeluaran Poin</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Master -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/manajemen-sampah/*') ? '' : 'collapsed' }}"
                data-bs-target="#manajemen-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Manajemen sampah</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="manajemen-nav"
                class="nav-content {{ request()->is('admin/manajemen-sampah/*') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/manajemen-sampah/ketegori-sampah') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.manajemen-sampah.ketegori-sampah.index') }}">
                        <i class="bi bi-circle"></i><span>Kategori Sampah</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/manajemen-sampah/kelola-poin') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.manajemen-sampah.kelola-poin.index') }}">
                        <i class="bi bi-circle"></i><span>Kelola Poin</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/manajemen-sampah/kelola-tempat', 'admin/manajemen-sampah/kelola-tempat/create', 'admin/manajemen-sampah/kelola-tempat/edit/*') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.manajemen-sampah.kelola-tempat.index') }}">
                        <i class="bi bi-circle"></i><span>Kelola Tempat Penjemputan</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/manajemen-sampah/kelola-jadwal') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.manajemen-sampah.kelola-jadwal.index') }}">
                        <i class="bi bi-circle"></i><span>Kelola Jawdal Penjemputan</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/manajemen-sampah/kelola-tugas') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.manajemen-sampah.kelola-tugas.index') }}">
                        <i class="bi bi-circle"></i><span>Kelola Petugas Penjemputan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Manajemen sampah -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/laporan/penukaran-poin', 'admin/laporan/pemasukan-sampah') ? '' : 'collapsed' }}"
                data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-newspaper"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="laporan-nav"
                class="nav-content {{ request()->is('admin/laporan/penukaran-poin', 'admin/laporan/pemasukan-sampah') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/laporan/penukaran-poin') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.laporan.penukaran-poin.index') }}">
                        <i class="bi bi-circle"></i><span>Laporan Penukaran Poin Nasabah</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/laporan/pemasukan-sampah') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.laporan.pemasukan-sampah.index') }}">
                        <i class="bi bi-circle"></i><span>Laporan Pemasukan Sampah</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Laporan -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/profile') ? 'active' : 'collapsed' }}"
                href="{{route('Admin.profile.index')}}">
                <i class="bi bi-person-circle"></i><span>Profile</span>
            </a>
        </li><!-- End Profile -->
        @endif

    </ul>

</aside><!-- End Sidebar-->
