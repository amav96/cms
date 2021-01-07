<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnectController extends Controller
{
    public function getLogin(){

        return view('connect.login');

    }

    public function getRegister(){

        return view('connect.register');

    }

    
}
