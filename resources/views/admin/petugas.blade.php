@extends('admin.base')

@section('title')
    Data Petugas
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
                <h5>Data Petugas</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Action</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->alamat}}</td>
                        <td>{{$d->no_hp}}<td>
                            <a class="btn btn-success btn-sm" id="editData" data-username="{{$d->username}}" data-hp="{{$d->no_hp}}" data-alamat="{{$d->alamat}}" data-nama="{{$d->nama}}" data-id="{{$d->id}}">Ubah</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{$d->id}}', '{{$d->nama}}') ">hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return Save()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <input  name="roles" value="petugas" hidden>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Petugas</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No Hp</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp">
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label for="username" class="form-label">UserName</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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
        $(document).ready(function () {

        })

        $(document).on('click', '#addData, #editData', function () {
            $('#tambahdata #id').val($(this).data('id'));
            $('#tambahdata #nama').val($(this).data('nama'));
            $('#tambahdata #alamat').val($(this).data('alamat'));
            $('#tambahdata #no_hp').val($(this).data('hp'));
            $('#tambahdata #username').val($(this).data('username'));
            $('#tambahdata #password_confirmation').val('');
            $('#tambahdata #password').val('');
            if($(this).data('id')){
                $('#tambahdata #password_confirmation').val('******');
                $('#tambahdata #password').val('******');
            }
            $('#tambahdata').modal('show');
        })

        function Save() {
            saveData('Simpan data petugas','form');
            return false;
        }

        function hapus(id, name) {
            deleteData(name,'/admin/petugas/'+id+'/delete');
            return false
        }
    </script>

@endsection
