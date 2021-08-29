@extends('admin.base')

@section('title')
    Data Pelanggan
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
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#tambahdata">Tambah Data</button>
            </div>

            <div class="d-flex justify-content-end mb-3">
               <div>
                   <form>
                       <label for="nocard" class="form-label">No. Kartu (scan) / Nama</label>
                       <input type="text" class="form-control" id="nocard" name="cari" value="{{request('cari')}}">
                       <button type="submit" hidden></button>
                   </form>
               </div>
            </div>
            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>No Kartu</th>
                        <th>Saldo</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->alamat}}</td>
                        <td>{{$d->no_hp}}</td>
                        <td>{{$d->username}}</td>
                        <td class="text-end">Rp. {{number_format($d->saldo, 0)}}</td>
                        <td>
                            <a class="btn btn-success btn-sm" id="editData" data-username="{{$d->username}}" data-hp="{{$d->no_hp}}" data-alamat="{{$d->alamat}}" data-nama="{{$d->nama}}" data-id="{{$d->id}}">Ubah</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{$d->id}}', '{{$d->nama}}') ">hapus</button>
                            <a class="btn btn-warning btn-sm" id="history" style="color: white"  data-id="{{$d->id}}">History</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="7">Tidak ada data</td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return Save()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <input  name="roles" value="user" hidden>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="nohp" class="form-label">No Hp</label>
                                <input type="text" class="form-control" id="nohp" name="no_hp">
                            </div>
                            <div class="mb-3">
                                <label for="nokartu" class="form-label">No Kartu (scan)</label>
                                <input type="text" class="form-control" id="nokartu" name="username">
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
        $(document).ready(function() {

        })

        $(document).on('click', '#editData', function () {
            $('#tambahdata #id').val($(this).data('id'));
            $('#tambahdata #nama').val($(this).data('nama'));
            $('#tambahdata #alamat').val($(this).data('alamat'));
            $('#tambahdata #nohp').val($(this).data('no_hp'));
            $('#tambahdata #nokartu').val($(this).data('username'));
            $('#tambahdata').modal('show');
        })

        $(document).on('click','#history', function () {
            $(this).attr('href','/admin/pelanggan/'+$(this).data('id')+'/history');
        })


        function Save() {
            saveData('Simpan data member','form');
            return false;
        }

        function hapus(id, name) {
            deleteData(name,'/admin/pelanggan/'+id+'/delete');
            return false
        }
    </script>

@endsection
