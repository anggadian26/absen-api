<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h5,
        h6 {
            margin: 0;
            font-weight: bold;
        }

        h6 {
            margin-top: 10px;
        }

        .text-center {
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-4 {
            width: 40%;
            float: left;
        }

        .col-3 {
            width: 20%;
            float: left;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            text-align: center;
            padding: 5px;
        }

        th.centered {
            vertical-align: middle;
        }

        .fw-bold {
            font-weight: bold;
        }

        .font-size {
            font-size: 12px;
        }

        .size-req {
            font-size: 14px;
        }


    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Laporan Presensi</h2>
        <div class="row">
            <div class="col-3">
                <p class="size-req">Tanggal</p>
            </div>
            <div class="col-4">
                <p class="size-req">: {{ $req->date_from }} - {{ $req->date_to }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <p class="size-req">Pegawai</p>
            </div>
            <div class="col-4">
                <p class="size-req">: {{ $req->user }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <p class="size-req" style="font-style: italic">Printed on {{ $req->print_on }}</p>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-12">
                <table>
                    <thead>
                        <tr style="background-color: #85E5F6">
                            <th class="text-center fw-bold">No</th>
                            <th class="text-center fw-bold">Tanggal</th>
                            <th class="text-center fw-bold">Jam Masuk</th>
                            <th class="text-center fw-bold">Jam Pulang</th>
                            <th class="text-center fw-bold">Longitude - Latitude</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $i)
                            <tr>
                                <td class="font-size">{{ $no++ }}</td>
                                <td class="font-size">{{ $i->tanggal }}</td>
                                <td class="font-size">{{ $i->masuk }}</td>
                                <td class="font-size">{{ $i->pulang }}</td>
                                <td class="font-size">{{ $i->longitude }}, {{ $i->latitude }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
