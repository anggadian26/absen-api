@extends('layouts.app')
@section('content')
    <h5 class="card-title">Riwayat Pengumuman</h5>

    <div class="mb-5 ">
        <form class="row g-3 align-items-end" action="{{ route('riwayatget') }}" method="get">
            @csrf
            <div class="col-md-2">
                <label for="inputName5" class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul"
                    value="{{ isset($_GET['judul']) ? $_GET['judul'] : '' }}">
            </div>
            <div class="col-md-2">
                <label for="inputName5" class="form-label">Tanggal Upload</label>
                <input type="date" class="form-control" name="tanggal_upload"
                    value="{{ isset($_GET['tanggal_upload']) ? $_GET['tanggal_upload'] : '' }}">
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
                <th scope="col">Tanggal Upload</th>
                <th scope="col">Tanggal Hapus</th>
                <th scope="col">Judul</th>
                <th scope="col">Konten</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @if (count($riwayat) < 1)
                <tr>
                    <td colspan="6">Data tidak ada.</td>
                </tr>
            @else
                @foreach ($riwayat as $x)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $x->tanggal_upload }}</td>
                        <td>{{ $x->tanggal_delete }}</td>
                        <td>{{ $x->judul }}</td>
                        <td>{{ $x->konten }}</td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
@endsection
