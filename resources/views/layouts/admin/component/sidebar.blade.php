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
        </li><!-- End Master -->

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
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->
        @endif

    </ul>

</aside><!-- End Sidebar-->