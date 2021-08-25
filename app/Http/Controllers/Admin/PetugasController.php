<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    //

    public function index(){
        $user = User::where('roles','=','petugas')->paginate(10);
        return view('admin.petugas')->with(['data' => $user]);
    }

    public function delete($id){
        User::destroy($id);
        response()->json('berhasil');
    }
}
