@extends('layouts.app')
@section('content')
    <h5 class="card-title">Data Ijin</h5>

    <div class="mb-5 ">
        <form class="row g-3 align-items-end" action="{{ route('ijin') }}" method="get">
            @csrf
            <div class="col-md-2">
                <label for="inputName5" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="date_from"
                    value="{{ isset($_GET['date_from']) ? $_GET['date_from'] : '' }}">
            </div>
            <div class="col-md-2">
                <label for="inputName5" class="form-label">Status</label>
                <select name="flg" class="form-select">
                    <option value="">- All -</option>
                    <option value="P" {{ isset($_GET['flg']) && $_GET['flg'] == 'P' ? 'selected' : '' }}>Pending</option>
                    <option value="A" {{ isset($_GET['flg']) && $_GET['flg'] == 'A' ? 'selected' : '' }}>Approved</option>
                    <option value="R" {{ isset($_GET['flg']) && $_GET['flg'] == 'R' ? 'selected' : '' }}>Rejected</option>
                </select>
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
                <th scope="col">Aksi</th>
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Dari Tanggal</th>
                <th scope="col">Sampai Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $x)
                <tr>
                    <td>
                        @if ($x->flg == 'P')
                            <a href="{{ route('action', ['id' => $x->id, 'flg' => 'R']) }}" class="btn btn-danger"><i
                                    class="bi bi-x-lg"></i></a>
                            <a href="{{ route('action', ['id' => $x->id, 'flg' => 'A']) }}" class="btn btn-success"><i
                                    class="bi bi-check-lg"></i></a>
                        @endif
                    </td>
                    <td>{{ $x->name }}</td>
                    <td>{{ $x->date_from }}, {{ $x->time_from }}</td>
                    <td>{{ $x->date_to }}, {{ $x->time_to }}</td>
                    <td>{{ $x->keterangan }}</td>
                    <td>
                        @if ($x->flg == 'A')
                            <span class="badge bg-success">Approved</span>
                        @endif
                        @if ($x->flg == 'R')
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                        @if ($x->flg == 'P')
                            <span class="badge bg-warning">Pending</span>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
