<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('dashboard')) active @else collapsed @endif" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link @if (request()->routeIs('data.pegawai')) active @else collapsed @endif"
                href="{{ route('data.pegawai') }}">
                <i class="bi bi-grid"></i>
                <span>Data Pegawai</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Data Presensi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Data Ijin</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Data Sakit</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Pengumuman</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
