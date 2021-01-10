<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function home(){
       return view('admin.products.home');
    }

    public function create(){

        return view('admin.products.create');
    }
}
