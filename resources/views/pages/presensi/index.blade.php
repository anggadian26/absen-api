@extends('layouts.app')
@section('content')
    <h5 class="card-title">Data Presensi</h5>
    <div class="mb-5 ">
        <form class="row g-3 align-items-end" action="{{ route('presensi') }}" method="get">
            @csrf
            <div class="col-md-2">
                <label for="inputName5" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggal"
                    value="{{ isset($_GET['tanggal']) ? $_GET['tanggal'] : '' }}">
            </div>
            <div class="col-md-2">
                <label for="inputName5" class="form-label">Bulan</label>
                <input type="month" class="form-control" name="bulan_tahun"
                    value="{{ isset($_GET['bulan_tahun']) ? $_GET['bulan_tahun'] : '' }}">
            </div>
            <div class="col-md-2">
                <label for="inputName5" class="form-label">Pegawai</label>
                <select name="user_id" class="form-select">
                    <option value="">- All -</option>
                    @foreach ($user as $o)
                        <option value="{{ $o->id }}"
                            {{ isset($_GET['user_id']) && (int) $_GET['user_id'] === $o->id ? 'selected' : '' }}>
                            {{ $o->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>
    <!-- Table with stripped rows -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jam Masuk</th>
                <th scope="col">Jam Pulang</th>
                <th scope="col">Longitude - Latitude</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($presensi as $x)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $x->name }}</td>
                    <td>{{ $x->tanggal }}</td>
                    <td>{{ $x->masuk }}</td>
                    <td>{{ $x->pulang }}</td>
                    <td>{{ $x->longitude }} - {{ $x->latitude }}</td>
                    <td>
                        @if ($x->flg == 'S')
                            <span class="badge rounded-pill bg-warning">Sakit</span>
                        @endif
                        @if ($x->flg == 'I')
                            <span class="badge rounded-pill bg-priamry">Ijin / Cuti</span>
                        @endif
                        @if ($x->flg == 'N')
                            <span class="badge rounded-pill bg-danger">Absen</span>
                        @endif
                        @if ($x->flg == 'P')
                            <span class="badge rounded-pill bg-info">Presensi</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item">
                <a class="page-link" href="{{ $presensi->previousPageUrl() }}" tabindex="-1"
                    aria-disabled="true">Previous</a>
            </li>

            @foreach (range(1, $presensi->lastPage()) as $page)
                <li class="page-item{{ $page == $presensi->currentPage() ? ' active' : '' }}">
                    <a class="page-link" href="{{ $presensi->url($page) }}">{{ $page }}</a>
                </li>
            @endforeach

            <li class="page-item">
                <a class="page-link" href="{{ $presensi->nextPageUrl() }}">Next</a>
            </li>
        </ul>
        <span>Total Data {{ $presensi->total() }} </span>
    </nav>
@endsection
