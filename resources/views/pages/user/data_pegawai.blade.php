@extends('layouts.app')
@section('content')
    <h5 class="card-title">Data Pegawai</h5>
    <div class="d-flex justify-content-end">
        <a href="{{ route('view.add') }}" class="btn btn-primary">Tambah</a>
    </div>
    
    <!-- Table with stripped rows -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
             @foreach ($user as $x)
            <tr>
               
                    <td>{{ $i++ }}</td>
                    <td>{{ $x->name }}</td>
                    <td>{{ $x->username }}</td>
                    <td>{{ $x->email }}</td>
                    <td>{{ $x->role }}</td>
                    <td>
                        <a href="{{ route('delete.user', ['id' => $x->id]) }}" class="btn btn-danger">Hapus</a>
                    </td>   
            </tr>
            @endforeach  
        </tbody>
    </table>
@endsection
