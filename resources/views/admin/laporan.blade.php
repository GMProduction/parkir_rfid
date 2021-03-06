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

    <section class="m-2">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Laporan</h5>
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


            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>No Kartu</th>
                    <th>No. Polisi</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Biaya Parkir</th>
                </tr>
                </thead>

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
            $(this).attr('href', '/admin/cetaklaporan?'+$('#formTanggal').serialize());
        })
    </script>

@endsection
