<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (auth()->user()->role == 'superadmin')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End dashboard  -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/master/akun', 'superadmin/master/monitoring-data-sampah', 'superadmin/master/akun-nasabah') ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content {{ request()->is('superadmin/master/akun', 'superadmin/master/monitoring-data-sampah', 'superadmin/master/akun-nasabah') ? '' : 'collapse' }} "
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
                <li>
                    <a class="{{ request()->is('superadmin/master/manajemen-isu') ? 'active' : 'collapsed' }}"
                        href="{{ route('SuperAdmin.master.monitoring-data-sampah.index') }}">
                        <i class="bi bi-circle"></i><span>Monitoring Sampah</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Master -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/konfirmasi-akun') ? 'active' : 'collapsed' }}"
                href="{{route('SuperAdmin.konfirmasi-akun.index')}}">
                <i class="bi bi-newspaper"></i><span>Konfrimasi Akun</span>
            </a>
        </li><!-- End konfirmasi Akun -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('superadmin/profile') ? 'active' : 'collapsed' }}"
                href="{{route('SuperAdmin.profile.index')}}">
                <i class="bi bi-newspaper"></i><span>Profile</span>
            </a>
        </li><!-- End Profile -->

        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : 'collapsed' }}"
                href="{{route('Admin.dashboard.index')}}">
                <i class="bi bi-newspaper"></i><span>Dashoard</span>
            </a>
        </li><!-- End Pengumuman -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/monitoring/monitoring', 'admin/monitoring/media-monitoring', 'admin/monitoring/manajemen-isu') ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Monitoring</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content {{ request()->is('admin/monitoring/monitoring', 'admin/monitoring/media-monitoring', 'admin/monitoring/manajemen-isu') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/monitoring/media-monitoring') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.monitoring.media-monitoring.index') }}">
                        <i class="bi bi-circle"></i><span>Media Monitoring</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/monitoring/manajemen-isu') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.monitoring.manajemen-isu.index') }}">
                        <i class="bi bi-circle"></i><span>Manajemen Isu</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Monitoring -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/data-media/permintaan-edit-data-perusahaan','admin/data-media/data-perusahaan', 'admin/data-media/media-order', 'admin/data-media/laporan','admin/data-media/kontrak','admin/data-media/klasifikasi-kerjasama-media') ? '' : 'collapsed' }}"
                data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Data Media</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav"
                class="nav-content {{ request()->is('admin/data-media/permintaan-edit-data-perusahaan','admin/data-media/data-perusahaan', 'admin/data-media/media-order', 'admin/data-media/laporan','admin/data-media/kontrak','admin/data-media/klasifikasi-kerjasama-media') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/data-media/data-perusahaan') ? 'active' : 'collapsed' }}"
                        href="{{route('Admin.data-media.data-perusahaan.index')}}">
                        <i class="bi bi-circle"></i><span>Data Perusahaan</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/data-media/media-order') ? 'active' : 'collapsed' }}"
                        href="{{route('Admin.data-media.media-order.index')}}">
                        <i class="bi bi-circle"></i><span>Media Order</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/data-media/laporan') ? 'active' : 'collapsed' }}"
                        href="{{route('Admin.data-media.laporan.index')}}">
                        <i class="bi bi-circle"></i><span>Laporan</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/data-media/klasifikasi-kerjasama-media') ? 'active' : 'collapsed' }}"
                        href="{{route('Admin.data-media.klasifikasi-kerjasama-media.index')}}">
                        <i class="bi bi-circle"></i><span>Klasifikasi Kerjasama Media</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/data-media/permintaan-edit-data-perusahaan') ? 'active' : 'collapsed' }}"
                        href="{{route('Admin.data-media.permintaan-edit-data-perusahaan.index')}}">
                        <i class="bi bi-circle"></i><span>Permintaan Edit Data ({{permintaanEditData()}})</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Data Media -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/setting/users', 'admin/setting/klasifikasi', 'admin/setting/lokus') ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear-fill"></i><span>Setting</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav"
                class="nav-content {{ request()->is('admin/setting/users', 'admin/setting/klasifikasi', 'admin/setting/lokus') ? '' : 'collapse' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/setting/users') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.Setting.users.index') }}">
                        <i class="bi bi-circle"></i><span>Users</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/setting/klasifikasi') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.Setting.klasifikasi.index') }}">
                        <i class="bi bi-circle"></i><span>Klasifikasi</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/setting/lokus') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.Setting.lokus.index') }}">
                        <i class="bi bi-circle"></i><span>Lokus</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Seeting -->
        @elseif (auth()->user()->jabatan == 'admin monitoring')

        <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin-monitoring/monitoring/media-monitoring', 'admin-monitoring/monitoring/manajemen-isu') ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Monitoring</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content {{ request()->is('admin-monitoring/monitoring/media-monitoring', 'admin-monitoring/monitoring/manajemen-isu') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin-monitoring/monitoring/media-monitoring') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin-monitoring.monitoring.media-monitoring.index') }}">
                        <i class="bi bi-circle"></i><span>Media Monitoring</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin-monitoring/monitoring/manajemen-isu') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin-monitoring.monitoring.manajemen-isu.index') }}">
                        <i class="bi bi-circle"></i><span>Manajemen Isu</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Manajemen Isu --> --}}

        {{-- Dinas --}}
        @elseif (auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/master/akun-petugas', 'admin/master/monitoring-sampah-petugas', 'admin/master/pemasukan-sampah','admin/master/pemasukan-pengeluaran-poin') ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content {{ request()->is('admin/master/akun-petugas', 'admin/master/monitoring-sampah-petugas', 'admin/master/pemasukan-sampah','admin/master/pemasukan-pengeluaran-poin') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/master/akun-petugas') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.master.akun-petugas.index') }}">
                        <i class="bi bi-circle"></i><span>Akun Petugas</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/master/monitoring-sampah-petugas') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.master.monitoring-sampah-petugas.index') }}">
                        <i class="bi bi-circle"></i><span>Monitoring Sampah Petugas</span>
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
                        <i class="bi bi-circle"></i><span>Monitoring Pemasukan & Pengeluaran Poin</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Master -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/manajemen-sampah/ketegori-sampah', 'admin/manajemen-sampah/kelola-poin', 'admin/manajemen-sampah/kelola-tempat','admin/manajemen-sampah/kelola-jadwal','admin/manajemen-sampah/kelola-tugas') ? '' : 'collapsed' }}"
                data-bs-target="#manajemen-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Manajemen sampah</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="manajemen-nav"
                class="nav-content {{ request()->is('admin/manajemen-sampah/ketegori-sampah', 'admin/manajemen-sampah/kelola-poin', 'admin/manajemen-sampah/kelola-tempat','admin/manajemen-sampah/kelola-jadwal','admin/manajemen-sampah/kelola-tugas') ? '' : 'collapse' }} "
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
                    <a class="{{ request()->is('admin/manajemen-sampah/kelola-tempat') ? 'active' : 'collapsed' }}"
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
                    <a class="{{ request()->is('admin/manajemen-sampah/kelola-jadwal') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.manajemen-sampah.kelola-tugas.index') }}">
                        <i class="bi bi-circle"></i><span>Kelola Petugas Penjemputan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Manajemen sampah -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/laporan/pemasukan-pengeluaran-poin', 'admin/laporan/pemasukan-sampah') ? '' : 'collapsed' }}"
                data-bs-target="#manajemen-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="manajemen-nav"
                class="nav-content {{ request()->is('admin/laporan/pemasukan-pengeluaran-poin', 'admin/laporan/pemasukan-sampah') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/laporan/pemasukan-pengeluaran-poin') ? 'active' : 'collapsed' }}"
                        href="{{ route('Admin.laporan.pemasukan-pengeluaran-poin.index') }}">
                        <i class="bi bi-circle"></i><span>Laporan Pemasukan & Pengeluaran Poin</span>
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
                <i class="bi bi-newspaper"></i><span>Profile</span>
            </a>
        </li><!-- End Profile -->
        @endif

    </ul>

</aside><!-- End Sidebar-->