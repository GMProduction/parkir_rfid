@extends('admin.base')

@section('title')
    Laporan
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif
    <style>
        .bg-red {
            background-color: #ff8393 !important;
        }
    </style>
    <section class="m-2">


        <div class="table-container">


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Laporan Saldo</h5>
                <form id="formTanggal">
                    <div class="d-flex align-items-center">
                        <i class='bx bx-calendar me-2' style="font-size: 1.4rem"></i>
                        <div class="me-2">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control me-2" name="start" value="{{request('start')}}" required>
                                <div class="input-group-addon">to</div>
                                <input type="text" class="form-control ms-2" name="end" value="{{request('end')}}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Cari</button>
                        <a class="btn btn-warning" id="cetak" target="_blank">Cetak</a>
                    </div>
                </form>

            </div>


            <table class="table table-bordered ">
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
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

        })

        function hapus(id, name) {
            swal({
                title: "Menghapus data?",
                text: "Apa kamu yakin, ingin menghapus data ?!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Berhasil Menghapus data!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data belum terhapus");
                    }
                });
        }
    </script>

    <script>
        $('.input-daterange input').each(function () {
            $(this).datepicker({
                dateFormat: "dd-mm-yy"
            });
        });

        $(document).on('click','#cetak', function () {
            console.log('/cetaklaporan?'+$('#formTanggal').serialize());
            $(this).attr('href', '/admin/cetaklaporansaldo?'+$('#formTanggal').serialize());
        })
    </script>

@endsection
