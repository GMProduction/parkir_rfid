<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Print Card</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" type="text/css">


</head>

<body>

    <style>
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0;
        }

        table { border: 1px solid #ccc; border-collapse: collapse; margin: 0; padding: 0; width: 100%; table-layout: fixed;}
      table caption { font-size: 1.5em; margin: .5em 0 .75em;}
      table tr { border: 1px solid #ddd; padding: .35em;}
      table th,
      table td { padding: .625em; text-align: center;}
      table th { font-size: .85em; letter-spacing: .1em; text-transform: uppercase;}
      @media screen and (max-width: 600px) {
        table { border: 0; }
        table caption { font-size: 1.3em; }
        table thead { border: none; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px;}
        table tr { border-bottom: 3px solid #ddd; display: block; margin-bottom: .625em; }
        table td { border-bottom: 1px solid #ddd; display: block; font-size: .8em; text-align: right;}
        table td::before { content: attr(data-label); float: left; font-weight: bold; text-transform: uppercase; }
        table td:last-child { border-bottom: 0; }
      }

    </style>

    <br>

    <div>
        <img src="{{ public_path('static-image/logo.png') }}" style="width: 120px; float: left;" />

        <div>
            <h4 style=" text-align: center;margin-bottom:0;margin-top:0">Laporan Saldo</h4>
            @if($start)
                <h5 style=" text-align: right;margin-bottom:0;margin-top:0">{{date('d F Y', strtotime($start))}} - {{date('d F Y', strtotime($end))}}</h5>
            @else
                <h5 style=" text-align: right;margin-bottom:0;margin-top:0">Semua</h5>
            @endif
        </div>

        <hr>

        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>No Kartu</th>
                <th>Status</th>
                <th>Nominal</th>
            </tr>
            </thead>
            <hr>
            <tbody>
            @forelse($data as $key => $d)
                <tr>
                    <td class="{{$d->status == 'kredit' ? 'bg-red' : ''}}">{{$key + 1}}</td>
                    <td class="{{$d->status == 'kredit' ? 'bg-red' : ''}}">{{date('d F Y H:i:s', strtotime($d->tanggal))}}</td>
                    <td class="{{$d->status == 'kredit' ? 'bg-red' : ''}}">{{$d->user->nama}}</td>
                    <td class="{{$d->status == 'kredit' ? 'bg-red' : ''}}">{{$d->user->username}}</td>
                    <td class="text-center {{$d->status == 'kredit' ? 'bg-red' : ''}}">{{$d->status}}</td>
                    <td class="text-end {{$d->status == 'kredit' ? 'bg-red' : ''}}">{{number_format($d->nominal, 0)}}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6">Tidak ada data</td>
                </tr>
            @endforelse
          </table>


    </div>




    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
