<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu.dashboard');
    }

    public function data_user()
    {
        return view('menu.data_user');
    }
}
