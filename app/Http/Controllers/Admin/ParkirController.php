<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterHarga;
use App\Models\Parkir;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    //

    public function index()
    {
        if (\request()->isMethod('POST')) {
            return $this->store();
        }
        $parkir = Parkir::latest()->paginate(10);

        return view('admin.parkir')->with(['data' => $parkir]);
    }

    public function store()
    {
        $field = [
            'tanggal_masuk' => now('Asia/Jakarta'),
            'user_id'       => \request('user_id'),
            'no_pol'        => \request('no_pol'),
        ];
        Parkir::create($field);

        return response()->json('berhasil');
    }

    public function update($id)
    {
        $parkir   = Parkir::find($id);
        $masuk    = strtotime($parkir->tanggal_masuk);
        $sekarang = strtotime(now('Asia/Jakarta'));
        $diff     = $sekarang - $masuk;
        $jam      = floor($diff / (60 * 60)) == 0 ? 1 : floor($diff / (60 * 60));

        $harga = MasterHarga::first();
        $biaya = (int)$harga->harga;
        $sisaSaldo = $this->cekSaldo($parkir->user_id);

        if ((int)$biaya > (int)$sisaSaldo){
            return response()->json(['data' => $parkir->user, 'msg' => 'Saldo tidak cukup', 'status' => 203]);
        }
        $parkir->update([
            'tanggal_keluar' => now('Asia/Jakarta'),
            'biaya_parkir' => $biaya]);
        $parkir   = Parkir::find($parkir->id);
        Saldo::create([
            'tanggal' => now('Asia/Jakarta'),
            'status' => 'kredit',
            'nominal' => $biaya,
            'user_id' => $parkir->user_id
        ]);
        return response()->json(['data' => $parkir,'status' => 202]);
    }

    public function getPelanggan($id)
    {
        $parkir = Parkir::where([['tanggal_keluar', '=', null], ['user_id', '=', $id]])->first();
        if ($parkir) {
            return response()->json(['data' => $parkir, 'status' => 200]);
        }

        return response()->json(['status' => 201]);

    }

    public function cekSaldo($id){
        $debit = Saldo::where([['status','=','debit'],['user_id','=',$id]])->sum('nominal');
        $kredit = Saldo::where([['status','=','kredit'],['user_id','=',$id]])->sum('nominal');
        $saldoSisa = $debit-$kredit;
        return $saldoSisa;
    }
}
