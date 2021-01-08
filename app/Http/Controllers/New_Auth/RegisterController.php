<?php

namespace App\Http\Controllers\New_Auth;

use App\Http\Controllers\Controller;
use App\Models\Master\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function postregister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'username' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data =  new UserModel();
        $data->company = $request->company;
        $data->name = $request->name;
        $data->jabatan = $request->jabatan;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->remember_token = Str::random(200);

        $data->save();
        return redirect('/')->with('alert-success', 'Proses Registrasi Berhasil Silahkan Konfirmasi Pada Pihak PT. Dasa Windu Agung untuk aktifasi Akun anda');
    }
}
