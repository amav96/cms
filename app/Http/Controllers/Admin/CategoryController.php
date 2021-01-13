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

    public function save(Request $request){
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

    public function edit($id){

        $category = Category::find($id);
       
        $data= ['category' => $category];

        return view('admin.categories.edit',$data);


    }

    public function update(Request $request, $id){
        
        //reglas de validacion

        $rules = [
            'name' => 'required',
            'module' => 'required',
            'icon' => 'required'
        ];
        //mensajes de valdiacion

        $message = [
            'name.required' => 'Debe ingresar un nombre de categoria',
            'module.required' => 'Debe escoger una modulo',
            'icon.required' => 'Debes ingresar un ícono'
        ];

        //validar la info que llega 

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Ocurrio un error')->with('typealert','danger');
        else:
            $category = Category::find($id);
            $category->name = e($request->input('name'));
            $category->module = $request->input('module');
            $category->slug = Str::slug($request->input('name'));
            $category->icon = e($request->input('icon'));

            if($category->save()):
                return back()->with('message','Editado con exito!')->with('typealert','success');
            endif;
        endif;

        //actualizar
    }

    public function delete($id){
        $category = Category::find($id);

        if($category->delete()):
            return back()->with('message','Eliminado correctamente')->with('typealert','success');
        endif;

    }
}
