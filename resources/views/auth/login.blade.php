@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 bg-login-image">
                            <img src="{{asset('asset/images/presensi.png')}}" alt="" class="login-image">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('LOGIN') }}</h1>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Ingatkan Saya') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Login Akun') }}
                                            </button>
                                            @if (Route::has('password.request'))
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
  


    .login-image {
        width: 100%;
        height: auto;
    }

    .h4 {
    color: #6f42c1;
    font-weight: bold;
}

.btn-primary {
    background-color: #6f42c1; /* Ganti warna latar belakang tombol menjadi ungu */
    border-color: #6f42c1; /* Ganti warna border tombol menjadi ungu */
    color: #fff; /* Ganti warna teks tombol menjadi putih */
}

.btn-primary:hover {
    background-color: #563d7c; /* Ganti warna latar belakang tombol hover menjadi ungu tua */
    border-color: #563d7c; /* Ganti warna border tombol hover menjadi ungu tua */
    color: #fff; /* Tetapkan warna teks tombol hover menjadi putih */
}

.card-body {
    border: none; /* Menghilangkan border dalam card-body */
    box-shadow: 0 4px 8px rgba(111, 66, 193, 0.2); /* Mengubah bayangan card-body menjadi ungu */
}

.form-control {
    border: none; /* Menghilangkan border pada input */
    box-shadow: 0 6px 12px rgba(111, 66, 193, 0.3), 0 0 0 2px rgba(111, 66, 193, 0.2); /* Mengubah bayangan input menjadi ungu dan membuatnya lebih tebal */
}

.invalid-feedback {
    color: #6f42c1; /* Mengubah warna teks feedback menjadi ungu */
}


</style>

@endsection
