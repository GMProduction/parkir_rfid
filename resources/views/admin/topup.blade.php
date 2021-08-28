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
                <h5>Data Topup Saldo</h5>

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
                    <th>Jumlah Topup</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$d->user->nama}}</td>
                        <td>{{$d->user->username}}</td>
                        <td>{{number_format($d->nominal, 0)}}</td>
                        <td>{{date('d F Y H:i:s', strtotime($d->tanggal))}}</td>

                        <td>
                            <a class="btn btn-success btn-sm" id="editData" data-nominal="{{$d->nominal}}" data-id="{{$d->id}}" data-nocard="{{$d->user->username}}">Ubah</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{$d->id}}', '{{$d->user->nama}}') ">hapus</button>
                        </td>
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
                        <form id="formTopup" onsubmit="return SaveTopup()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <input id="user_id" name="user_id" hidden>
                            <div class="mb-3 mt-3">
                                <label for="nominal" class="form-label">Topup</label>
                                <input type="text" class="form-control" id="nominal" name="nominal">
                                <span class="text-muted">Minimal topup Rp. 2.000</span>
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

        $(document).ready(function () {
            $("#nocard").focus();
        })

        $(document).keypress(function (e) {
            if ($("#nocard") && (e.keycode == 13 || e.which == 13)) {
                $('#formTopup #id').val('');
                $('#formTopup #nominal').val('');
                getPelanggan($("#nocard").val())
            }
        });

        function getPelanggan(nocard) {

            $.get('/admin/detail-pelanggan/' + nocard, function (data) {
                if (data) {
                    console.log(data)
                    $('#tambahdata #nama').val(data['nama'])
                    $('#tambahdata #alamat').val(data['alamat'])
                    $('#tambahdata #nohp').val(data['no_hp'])
                    $('#tambahdata #saldo').val(data['saldo'].toLocaleString())
                    $('#tambahdata #user_id').val(data['id'])
                    myModal.show();
                    $('#tambahdata #nominal').focus()
                } else {
                    swal("Data tidak ditemukan").then((dat) => {
                        $("#nocard").val('').focus();
                    });
                }
            })
        }

        $(document).on('click','#editData', function () {
            var nocard = $(this).data('nocard');
            $('#formTopup #id').val($(this).data('id'));
            $('#formTopup #nominal').val($(this).data('nominal'));
            getPelanggan(nocard);
        })

        $('#tambahdata').on('hidden.bs.modal', function () {
            $("#nocard").val('').focus();
        });

        function SaveTopup() {
            if (parseInt($('#nominal').val()) < 2000 ){
                swal('Maaf, minimal topup saldo senilai Rp. 2.000,-',{button: false, icon: 'warning',timer: 1000})
                return false
            }
            saveData('Topup Saldo', 'formTopup')
            return false;
        }

        function hapus(id, name) {
            deleteData(name,'/admin/topup/'+id+'/delete');
            return false
        }
    </script>

@endsection
