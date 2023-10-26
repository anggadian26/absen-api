<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href="{{ asset('asset/images/presensi.png') }}" rel="icon" type="image/png">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Presensi | RPL</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="app.png" rel="icon" type="app/png">

    <!-- Styles -->
    <style>
    html,
    body {
        background-color: #6f42c1;
        color: #fff;
        font-family: 'comic sans', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #fff;
        padding: 0 25px;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .links > a:hover {
        text-shadow: 4px 4px 8px rgba(0, 0, 0, 1.0);
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                     
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Presensi
            </div>

            

           
        </div>
    </div>
    
</body>

</html>
