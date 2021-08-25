<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parkir;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function getData(){
        $start = \request('start');
        $end = \request('end');
        $parkir = Parkir::latest();
        if ($start){
           $parkir = $parkir->whereBetween('tanggal_masuk', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        }
        $parkir = $parkir->paginate(10);
        return $parkir;
    }

    public function index(){

        $parkir = $this->getData();
        return view('admin.laporan')->with(['data' => $parkir]);
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
        return view('admin/cetaklaporan')->with($data);
    }
}
