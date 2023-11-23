@extends('layouts.app')
@section('content')
<h5 class="card-title">Download Report Presensi</h5>
<form action="{{ route('download') }}" method="get">
    @csrf
    <div class="row mb-3">
        <label for="inputText" class="col-sm-2 col-form-label">Tanggal</label>
        <div class="col-sm-2">
            <input type="date" class="form-control" name="date_from">
        </div>
        <div class="col-sm-1 text-center">
            <span>sampai</span>
        </div>
        <div class="col-sm-2">
            <input type="date" class="form-control" name="date_to">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputText" class="col-sm-2 col-form-label">Pegawai</label>
        <div class="col-sm-5">
            <select name="user_id" class="form-select">
                <option value="">- Semua -</option>
                @foreach ($user as $o)
                    <option value="{{ $o->id }}"
                        {{ isset($_GET['user_id']) && (int) $_GET['user_id'] === $o->id ? 'selected' : '' }}>
                        {{ $o->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="row mt-5 justify-content-end pe-5">
        
        <div class="col-sm-5">
          <button type="submit" class="btn btn-primary pe-5 ps-5">Download</button>
        </div>
    </div>
    
</form>
@endsection
