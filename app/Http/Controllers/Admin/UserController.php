<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getUsers(){
        //obtener datos mediante una consulta con eloquent
       $users = User::orderBy('id', 'DESC')->get();
       //guardar resulset en variable data
       $data = ['users' => $users];
        //pasar variable $data a la vista para recorrerla
       return view('admin.users.home', $data);
    }

    
}
