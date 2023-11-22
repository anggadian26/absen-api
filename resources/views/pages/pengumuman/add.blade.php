@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('pengumuman') }}" class="btn btn-warning">Kembali</a>
    </div>
    <h5 class="card-title">Tambah Pengumuman</h5>
    <form action="{{ route('add_pengumuman') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="judul">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Konten</label>
            <div class="col-sm-5">
                <textarea class="form-control" id="floatingTextarea" name="konten" style="height: 200px;"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Tanggal Hapus</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" name="tanggal_delete">
                <p class="" style="font-size: 12px; margin-left: 5px">pengumuman dihapus otomotis susuai dengan isi tanggal hapus</p>
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
