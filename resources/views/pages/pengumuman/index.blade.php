@extends('layouts.app')
@section('content')
<h5 class="card-title">Pengumuman</h5>
<div class="d-flex justify-content-end">
    <a href="{{ route('add.pengumuman') }}" class="btn btn-primary">Tambah</a>

    <div class="row g-3 align-items-center mt-2">
        <label for="search" class="form-label">
            Cari
        </label>
        <div class="col-auto">
            <form action="/index" method="GET">
                <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
            </form>
        </div>
      </div>

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
            $i = 1
        @endphp
        @foreach ($data as $x)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $x->tanggal_upload }}</td>
                <td>{{ $x->tanggal_delete }}</td>
                <td>{{ $x->judul }}</td>
                <td>{{ $x->konten }}</td>
                <td>
                    <a href="{{ route('delete.pengumuman', ['id' => $x->id]) }}" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
