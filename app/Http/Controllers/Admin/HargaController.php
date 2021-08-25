<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterHarga;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    //
    public function index(){
        if (\request()->isMethod('POST')){
            $nominal = str_replace(',','',\request('harga'));
            if (\request('id')){
                $harga = MasterHarga::find(\request('id'));
                $harga->update(['harga' => $nominal]);
            }else{
                MasterHarga::create(\request()->all());
            }
            return response()->json('berhasil');
        }
        $harga = MasterHarga::first();
        return view('admin.masterharga')->with(['data' => $harga]);
    }
}
