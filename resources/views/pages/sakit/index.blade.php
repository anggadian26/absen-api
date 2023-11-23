@extends('layouts.app')
@section('content')
<h5 class="card-title">Data Sakit</h5>
<div class="mb-5 ">
    <form class="row g-3 align-items-end" action="{{ route('sakit') }}" method="get">
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
                <td>{{ $x->tanggal }}</td>
                <td>{{ $x->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
