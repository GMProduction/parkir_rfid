<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    //

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        $saldo = Saldo::where('status','=','debit')->latest()->paginate(10);
        return view('admin.topup')->with(['data' => $saldo]);
    }

    public function store(){
        $field = [
            'tanggal' => now('Asia/Jakarta'),
            'nominal' => \request('nominal'),
            'user_id' => \request('user_id'),
            'status' => 'debit'
        ];
        if (\request('id')){
            $saldo = Saldo::find(\request('id'));
            $saldo->update($field);
        }else{
            Saldo::create($field);
        }
    }

    public function delete($id){
        Saldo::destroy($id);
        return response()->json('berhasil');
    }

}
