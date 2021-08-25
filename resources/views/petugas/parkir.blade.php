@extends('petugas.base')

@section('title')
    Parkir
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
                <h5>Data Parkir</h5>

                <div class="mb-3">
                    <label for="nocard" class="form-label">No. Kartu (scan)</label>
                    <input type="text" class="form-control" id="nocard">
                </div>
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
                        <td>{{$d->tanggal_keluar ? date('d F Y H:i:s', strtotime($d->tanggal_keluar)) : '-'}}</td>
                        <td class="text-end">Rp. {{$d->biaya_parkir ? number_format($d->biaya_parkir, 0) : '-'}}</td>
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


        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Topup Saldo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="border rounded p-3">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan</label>
                                <input type="text" readonly class="form-control" id="nama">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" readonly class="form-control" id="alamat">
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
                        <form id="form" onsubmit="return Save()">
                            @csrf
                            <input id="user_id" name="user_id" hidden>

                            <div class="mb-3 mt-3">
                                <label for="nopol" class="form-label">Masukan No. Polisi</label>
                                <input type="text" class="form-control" id="nopol" name="no_pol">
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
        var tglKeluar = null;
        $(document).ready(function () {
            $("#nocard").focus();
        })

        $(document).keypress(function (e) {
            if ($("#nocard") && (e.keycode == 13 || e.which == 13)) {
                getPelanggan($("#nocard").val())
            }
        });

        function getPelanggan(nocard) {
            $.get('/petugas/detail-pelanggan/' + nocard, function (data) {
                if (data) {
                    $.get('/petugas/parkir/get-pelanggan/' + data['id'], function (response) {
                        console.log(response)
                        if (response['status'] === 200) {
                            var token = {
                                '_token': '{{csrf_token()}}'
                            }
                            $.post('/petugas/parkir/'+response['data']['id']+'/update',token, function (jqXHR, textStatus, errorThrown) {
                                console.log(jqXHR)
                                if (jqXHR){
                                    if (jqXHR['status'] === 203){
                                        swal("Member "+jqXHR['data']['nama']+" Saldo tidak cukup, Silahkan mengisi saldo").then((dat) => {
                                            $('#nocard').val('').focus()
                                        });
                                    }else {
                                        swal("Member "+jqXHR['data']['user']['nama']+" dengan nomor polisi kendaraan "+jqXHR['data']['no_pol']+" telah keluar", { icon: "success",button: false, timer: 1000}).then((dat) => {
                                            window.location.reload();
                                        });
                                    }

                                }
                            })
                        } else {
                            $('#tambahdata #nama').val(data['nama'])
                            $('#tambahdata #alamat').val(data['alamat'])
                            $('#tambahdata #nohp').val(data['no_hp'])
                            $('#tambahdata #saldo').val(data['saldo'].toLocaleString())
                            $('#tambahdata #user_id').val(data['id'])
                            myModal.show();
                            $('#tambahdata #form #nopol').val('').focus()
                        }
                    });
                } else {
                    swal("Data tidak ditemukan").then((dat) => {
                        $("#nocard").val('').focus();
                    });
                }
            })
        }

        $('#tambahdata').on('hidden.bs.modal', function () {
            $("#nocard").val('').focus();
        });

        function Save() {
            saveData('Simpan data parkir masuk', 'form')
            return false;
        }


    </script>

@endsection
