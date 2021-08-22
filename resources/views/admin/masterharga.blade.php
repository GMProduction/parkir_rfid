@extends('admin.base')

@section('title')
    Data Admin
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2 w-50">


        <div class="table-container">


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Master Harga</h5>
               
            </div>

            <div class="border rounded p-3">
                <div class="mb-3">
                    <label for="nama" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="nama">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </div>

           
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

@endsection
