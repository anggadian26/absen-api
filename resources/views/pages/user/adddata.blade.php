@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('data.pegawai') }}" class="btn btn-warning">Kembali</a>
    </div>
    <h5 class="card-title">Tambah Pegawai</h5>
    <form action="{{ route('add.action') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="username">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" name="email">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="Pegawai" disabled name="role">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="password">
            </div>
        </div>
        <div class="row mb-5">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-5">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        
    </form>
@endsection
