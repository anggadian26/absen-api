<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('dashboard')) active @else collapsed @endif"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav --> --}}

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('data.pegawai', 'view.add')) active @else collapsed @endif"
                href="{{ route('data.pegawai') }}">
                <i class="bi bi-grid"></i>
                <span>Data Pegawai</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link  @if (request()->routeIs('presensi', 'report')) active @else collapsed @endif" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-grid"></i><span>Presensi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse @if (request()->routeIs('presensi', 'report')) show @else active @endif" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link @if (request()->routeIs('presensi')) active @else collapsed @endif"
                        href="{{ route('presensi') }}">
                        <i class="bi bi-grid"></i>
                        <span>Data Presensi</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link @if (request()->routeIs('report')) active @else collapsed @endif"
                        href="{{ route('report') }}">
                        <i class="bi bi-grid"></i>
                        <span>Report Presensi</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('ijin')) active @else collapsed @endif"
                href="{{ route('ijin') }}">
                <i class="bi bi-grid"></i>
                <span>Data Ijin</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('sakit')) active @else collapsed @endif"
                href="{{ route('sakit') }}">
                <i class="bi bi-grid"></i>
                <span>Data Sakit</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('pengumuman', 'add.pengumuman', 'riwayatget')) active @else collapsed @endif" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-grid"></i><span>Pengumuman</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse @if (request()->routeIs('pengumuman', 'add.pengumuman', 'riwayatget')) show @else active @endif" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link @if (request()->routeIs('pengumuman', 'add.pengumuman')) active @else collapsed @endif"
                        href="{{ route('pengumuman') }}">
                        <i class="bi bi-grid"></i>
                        <span>Pengumuman Aktif</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link @if (request()->routeIs('riwayatget')) active @else collapsed @endif"
                        href="{{ route('riwayatget') }}">
                        <i class="bi bi-grid"></i>
                        <span>Riwayat Pengumuman</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside><!-- End Sidebar-->
