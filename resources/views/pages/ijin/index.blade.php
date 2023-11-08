@extends('layouts.app')
@section('content')
<h5 class="card-title">Data Ijin</h5>

<!-- Table with stripped rows -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pegawai</th>
            <th scope="col">Dari Tanggal</th>
            <th scope="col">Sampai Tanggal</th>
            <th scope="col">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1
        @endphp
        @foreach ($data as $x)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $x->name }}</td>
                <td>{{ $x->date_from }}, {{ $x->time_from }}</td>
                <td>{{ $x->date_to }}, {{ $x->time_to }}</td>
                <td>{{ $x->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection