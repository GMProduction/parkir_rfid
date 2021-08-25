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
<style>
    .bg-red {
        background-color: #ff8393 !important;
    }
</style>
    <section class="m-2">


        <div class="table-container">


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>History Saldo {{$user->nama}}</h5>
                <h5>Saldo : Rp. {{number_format($saldo, 0)}}</h5>
            </div>


            <table class="table  table-bordered ">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Nominal</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td class="{{$d->status == 'kredit' ? 'bg-red' : ''}}">{{$key + 1}}</td>
                        <td class="{{$d->status == 'kredit' ? 'bg-red' : ''}}">{{date('d F Y H:i:s', strtotime($d->tanggal))}}</td>
                        <td class="{{$d->status == 'kredit' ? 'bg-red' : ''}}">{{$d->status}}</td>
                        <td class="text-end {{$d->status == 'kredit' ? 'bg-red' : ''}}">Rp. {{number_format($d->nominal, 0)}}</td>
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

    </script>

@endsection
