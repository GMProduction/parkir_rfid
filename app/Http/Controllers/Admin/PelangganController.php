<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    //

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        $user = User::where('roles','=','user')->filter(\request('cari'))->paginate(10);
        foreach ($user as $key => $u) {
            $debit  = Saldo::where([['status', '=', 'debit'], ['user_id', '=', $u->id]])->sum('nominal');
            $kredit = Saldo::where([['status', '=', 'kredit'], ['user_id', '=', $u->id]])->sum('nominal');
            $saldo  = $debit - $kredit;
            Arr::set($user[$key], 'saldo', $saldo);
        }
        return view('admin.pelanggan')->with(['data' => $user]);
    }

    public function store(){
        $field = \request()->validate([
            'username' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required'
        ]);

        Arr::set($field,'roles', 'user');
        Arr::set($field,'password', Hash::make('user'));

        if (\request('id')){
            $user = User::find(\request('id'));
            $user->update($field);
        }else{
            User::create($field);
        }

        return response()->json('berhasil');
    }

    public function delete($id){
        User::destroy($id);
        response()->json('berhasil');
    }

    public function getPelanggan($id){
        $user = User::where([['username','=',$id],['roles','=','user']])->first();
        if ($user){
            $debit = Saldo::where([['status','=','debit'],['user_id','=',$user->id]])->sum('nominal');
            $kredit = Saldo::where([['status','=','kredit'],['user_id','=',$user->id]])->sum('nominal');
            $saldo = $debit-$kredit;
            Arr::set($user,'saldo',$saldo);
        }

        return $user;
    }

    public function historySaldo($id){
        $saldo = Saldo::where('user_id','=',$id)->latest()->paginate(10);
        $debit = Saldo::where([['status','=','debit'],['user_id','=',$id]])->sum('nominal');
        $kredit = Saldo::where([['status','=','kredit'],['user_id','=',$id]])->sum('nominal');
        $user = User::find($id);
        $saldoSisa = $debit-$kredit;
        $data = [
            'data' => $saldo,
            'saldo' => $saldoSisa,
            'user' => $user
        ];
        return view('admin.pelangganHistory')->with($data);
    }
}
