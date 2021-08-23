@extends('admin.base')

@section('title')
    Topup
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
                <h5>Data Pelanggan</h5>

                <div class="mb-3">
                    <label for="nocard" class="form-label">No. Kartu (scan)</label>
                    <input type="text" class="form-control" id="nocard">
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
                        Jumlah Topup
                    </th>

                    <th>
                        Action
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
                        30000
                    </td>

                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#tambahdata">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>




        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Topup Saldo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="border rounded p-3">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan</label>
                                <input type="text" readonly class="form-control" id="nama">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" readonly  class="form-control" id="alamat">
                            </div>

                            <div class="mb-3">
                                <label for="nohp" class="form-label">No Hp</label>
                                <input type="text" readonly class="form-control" id="nohp">
                            </div>
                           
                            <div class="mb-3">
                                <label for="saldo" class="form-label">Saldo</label>
                                <input type="text" readonly class="form-control" id="saldo">
                            </div>
                        </div>
                            <div class="mb-3 mt-3">
                                <label for="topup" class="form-label">Topup</label>
                                <input type="text" class="form-control" id="topup">
                            </div>

                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </section>

@endsection

@section('script')
    <script>
        var myModal = new bootstrap.Modal(document.getElementById("tambahdata"), {});

        $(document).ready(function() {

        })

        $(document).keypress(function(e) {
            if ($("#nocard") && (e.keycode == 13 || e.which == 13)) {
                myModal.show();
            }
        });

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

@endsection