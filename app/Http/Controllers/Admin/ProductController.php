<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category,App\Http\Models\Product ;
use Validator,Str,Config;

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
        $categories = Category::where('module','0')->pluck('name','id');
        $data = ['categories' => $categories];
        

        return view('admin.products.create',$data);
    }

    public function save(Request $request){

        $rules = [
            'name' => 'required',
            'image' => 'required',
            'category' => 'required',
            'price' => 'required',
            'indiscount' => 'required',
            'content' => 'required',
        ];

        $message = [
            'name.required' => 'Debes ingresar el nombre del producto',
            'image.required' => 'Selecciona una imagen destacada',
            'image.image' => 'El archivo no es una imagen',
            'category.required' => 'Debes seleccionar una categoria',
            'price.required' => 'Debes ingresar el precio del producto',
            'indiscount.required' => 'Debes indicar si esta en descuento el producto',
            'content.required' => 'Debes ingresar una descripción del producto'
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Ocurrio un error')->with('typealert','danger')->withInput();
        else:

            //carpeta con fechas a guardar
            $path = '/'.date('Y-m-d');
            //extension del archivo
            $fileExt = trim($request->file('image')->getClientOriginalExtension()); 
            //nombre del archivo tal y como esta en la computadora
            $nameImg = $request->file('image')->getClientOriginalName(); 
            //para guardar en fylesystem : se agrega un key en config/filesystem. Para Prod hay que poner la ruta del hosting
            $upload_path = Config::get('filesystems.disk.uploads.root');
            //limpiando el nombre
            $name = Str::slug(str_replace($fileExt,'',$nameImg));
            //nombre final
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $product =  new Product;
            $product->status = '0';
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if($product->save()):
                //compruebo si existe un archivo con el name image
                  if($request->hasFile('image')):
                    //si existe, seteo el campo imagen y storeAs Recibe tres parametros, 1)la ruta final, 2)el nombre del archivo,3)carpeta donde se guarda
                    $file = $request->image->storeAs($path, $filename, 'uploads');
                  endif;

                return redirect('/admin/products')->with('message','Producto creado correctamente')->with('typealert','success');

            endif;
           
        endif;

        


      
    }
}
