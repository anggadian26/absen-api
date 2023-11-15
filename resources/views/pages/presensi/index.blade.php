@extends('layouts.app')
@section('content')
<h5 class="card-title">Data Presensi</h5>

<!-- Table with stripped rows -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pegawai</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Jam Masuk</th>
            <th scope="col">Jam Pulang</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1
        @endphp
        @foreach ($presensi as $x)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $x->name }}</td>
                <td>{{ $x->tanggal }}</td>
                <td>{{ $x->masuk }}</td>
                <td>{{ $x->pulang }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection