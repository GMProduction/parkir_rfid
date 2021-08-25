<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomController
{
    //
    //
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $fieldUser = \request()->validate(
            [
                'roles' => 'required',
                'nama'   => 'required|string',
                'alamat' => 'required',
                'no_hp'  => 'required',

            ]
        );

        $fieldPassword = \request()->validate(
            [
                'password' => 'required|confirmed',
            ]
        );

        $number = strpos($fieldUser['no_hp'],"0") == 0 ? preg_replace('/0/','62',$fieldUser['no_hp'],1) : $fieldUser['no_hp'];


        if (\request('id')){
            $username = User::where([['username', '=', \request('username')], ['id', '!=', \request('id')]])->first();
            if ($username) {
                return \request()->validate(
                    [
                        'username' => 'required|string|unique:users,username',
                    ]
                );
            }
            if (strpos($fieldPassword['password'], '*') === false) {
                $password = Hash::make($fieldPassword['password']);
                Arr::set($fieldUser, 'password', $password);
            }
            $user = User::find(\request('id'));
            $user->update($fieldUser);
        }else{
            $field = \request()->validate(
                [
                    'username' => 'required|string|unique:users,username',
                ]
            );

            $user = User::create(
                [
                    'username' => $field['username'],
                    'roles'    => $fieldUser['roles'],
                    'password' => Hash::make($fieldPassword['password']),
                    'nama'     => $fieldUser['nama'],
                    'alamat'   => $fieldUser['alamat'],
                    'no_hp'    => $number,
                ]
            );
        }

        return response()->json(['msg' => 'berhasil mendaftar'], 200);

    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        $credentials = [
            'username' => \request('username'),
            'password' => \request('password'),
        ];
        if ($this->isAuth($credentials)) {
            $redirect = '/';
            if (Auth::user()) {
                return redirect('/'.Auth::user()->roles);
            }

            return redirect()->back();
        }

        return response()->json(['msg' => 'Login gagal'],201);
    }



    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
