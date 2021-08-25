<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use Illuminate\Http\Request;

class LaporanSaldoController extends Controller
{
    //

    public function getData(){
        $start = \request('start');
        $end = \request('end');
        $saldo = Saldo::latest();
        if ($start){
            $saldo = $saldo->whereBetween('tanggal', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        }
        $saldo = $saldo->paginate(10);
        return $saldo;
    }

    public function index(){
        $saldo = $this->getData();
        return view('admin.laporanSaldo')->with(['data' => $saldo]);
    }

    public function cetakLaporan()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataLaporan())->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function dataLaporan()
    {
        $data = [
            'data' => $this->getData(),
            'start' => \request('start'),
            'end' => \request('end'),
        ];
        return view('admin/cetaklaporansaldo')->with($data);
    }
}
