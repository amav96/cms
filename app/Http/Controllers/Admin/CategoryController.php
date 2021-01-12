<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use Validator,Str;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function home($module){
        
        $categories = Category::where('module',$module)->orderBy('name','asc')->get();
        $data = ['categories' => $categories];
    
        return view('admin.categories.home',$data);
    }

    public function create(Request $request){
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría',
            'icon.required' => 'Se requiere un icono para la categoría'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()): 
             return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');
        else:
        
            $category = new Category;
            $category->module = $request->input('module');
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name'));
            $category->icon = e($request->input('icon'));

            if($category->save()): 
                return back()->with('message','Guardado con éxito!')->with('typealert','success');
            else:

            endif;
        endif;
    }
}
