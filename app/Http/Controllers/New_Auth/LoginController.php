<?php

namespace App\Http\Controllers\New_Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Master\UserModel;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $data = UserModel::where('username', $request->username)->first();

        if ($data === null) {
            return redirect('/')->with('alert-error', 'User Tidak Terdaftar !');
        } else {
            if ($request->password == $data->passnoen) {
                session::put('sess_username', $data->username);
                session::put('sess_email', $data->email);
                session::put('sess_email_verified', $data->email_verified);
                session::put('sess_vendor_id', $data->vendor_id);
                session::put('sess_vendor_code', $data->vendor_code);
                session::put('sess_fullname', $data->vendor_name);
                session::put('sess_jabatan', $data->jabatan);
                session::put('sess_rr', $data->RR);
                session::put('sess_coi', $data->COI);
                session(['berhasil_login' => true]);
                return redirect('/dashboard');
            } else {
                return redirect('/')->with('alert-error', 'Password Salah !');
            }
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/')->with('alert', 'Anda berhasil logout');
    }
}
