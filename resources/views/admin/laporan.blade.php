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
                <div class="d-flex align-items-center">
                    <i class='bx bx-calendar me-2' style="font-size: 1.4rem"></i>

                    <div class="me-2">
                        <input type="text" class="form-control" id="datepicker">
                    </div>

                    <a class="btn btn-warning" href="/cetaklaporan/{date}">Cetak</a>
                </div>

            </div>


            <table class="table table-striped table-bordered ">
                <thead>
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

                 

                </thead>

                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        Andi
                    </td>
                    <td>
                        12312412412
                    </td>
                    <td>
                        AD 1234 SS
                    </td>

                    <td>
                        23-08-2021 12:00:00
                    </td>

                    <td>
                        23-08-2021 16:00:00
                    </td>

                    <td>
                       3000
                    </td>

                 
                </tr>

            </table>

        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

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
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "dd-mm-yy"
            });
        });
    </script>

@endsection
