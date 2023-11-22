@extends('layouts.app')
@section('content')
    <h5 class="card-title">Pengumuman</h5>
    <div class="d-flex justify-content-end">
        <a href="{{ route('add.pengumuman') }}" class="btn btn-primary ps-5 pe-5">Tambah</a>
    </div>

    <div class="mb-5 ">
        <form class="row g-3 align-items-end" action="{{ route('pengumuman') }}" method="get">
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
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @if (count($data) < 1)
                <tr>
                    <td colspan="6">Data tidak ada.</td>
                </tr>
            @else
                @foreach ($data as $x)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $x->tanggal_upload }}</td>
                        <td>{{ $x->tanggal_delete }}</td>
                        <td>{{ $x->judul }}</td>
                        <td>{{ $x->konten }}</td>
                        <td>
                            <a href="{{ route('delete.pengumuman', ['id' => $x->id]) }}" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
