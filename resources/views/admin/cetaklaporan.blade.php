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
            <h4 style=" text-align: center;margin-bottom:0;margin-top:0">Laporan Parkir</h4>
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
                <th>
                    #
                </th>

                <th>
                    Nama
                </th>

                <th>
                    No Kartu
                </th>

                <th>
                    No. Polisi
                </th>

                <th>
                    Tanggal Masuk
                </th>

                <th>
                    Tanggal Keluar
                </th>

                <th>
                    Biaya Parkir
                </th>
              </tr>
            </thead>
            <hr>
            <tbody>
            @forelse($data as $key => $d)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$d->user->nama}}</td>
                    <td>{{$d->user->username}}</td>
                    <td>{{$d->no_pol}}</td>
                    <td>{{date('d F Y H:i:s', strtotime($d->tanggal_masuk))}}</td>
                    <td>{{date('d F Y H:i:s', strtotime($d->tanggal_keluar))}}</td>
                    <td class="text-end">Rp. {{number_format($d->biaya_parkir, 0)}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse

            </tbody>
          </table>


    </div>




    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
