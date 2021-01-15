<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category,App\Http\Models\Product,App\Http\Models\ProductGallery ;
use Validator,Str,Config, Image;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function home(){

        $products = Product::with(['category'])->orderBy('id','desc')->paginate(25);
        $data = ['products' => $products];


       return view('admin.products.home',$data);
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
            $upload_path = Config::get('filesystems.disks.uploads.root');
            //limpiando el nombre
            $name = Str::slug(str_replace($fileExt,'',$nameImg));
            //nombre final
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $final_file = $upload_path.'/'.$path.'/'.$filename;

            $product =  new Product;
            $product->status = '0';
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = $request->input('content');

            if($product->save()):
                //compruebo si existe un archivo con el name image
                  if($request->hasFile('image')):
                    //si existe, seteo el campo imagen y storeAs Recibe tres parametros, 1)la ruta final, 2)el nombre del archivo,3)carpeta donde se guarda
                    $file = $request->image->storeAs($path, $filename, 'uploads');

                    //crear miniatura de la imagen
                    $img =  Image::make($final_file);
                    
                    $img->fit(256,256,function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                  endif;

                return redirect('/admin/products')->with('message','Producto creado correctamente')->with('typealert','success');

            endif;
           
        endif;

        


      
    }

    public function edit($id){

        $product = Product::findOrFail($id);

        $categories = Category::where('module','0')->pluck('name','id');
        $data = ['categories' => $categories,'product' => $product];

        return view('admin.products.edit',$data);
    }

    public function update(Request $request, $id){

        $rules = [
            'name' => 'required',
            'image' => 'image',
            'category' => 'required',
            'price' => 'required',
            'indiscount' => 'required',
            'content' => 'required',
        ];

        $message = [
            'name.required' => 'Debes ingresar el nombre del producto',
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

            $product =  Product::findOrFail($id);
            $product->status = $request->input('status');
            $product->name = e($request->input('name'));
            $product->category_id = $request->input('category');

           if($request->hasFile('image')):

            //carpeta con fechas a guardar
            $path = '/'.date('Y-m-d');
            //extension del archivo
            $fileExt = trim($request->file('image')->getClientOriginalExtension()); 
            //nombre del archivo tal y como esta en la computadora
            $nameImg = $request->file('image')->getClientOriginalName(); 
            //para guardar en fylesystem : se agrega un key en config/filesystem. Para Prod hay que poner la ruta del hosting
            $upload_path = Config::get('filesystems.disks.uploads.root');
            //limpiando el nombre
            $name = Str::slug(str_replace($fileExt,'',$nameImg));
            //nombre final
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $final_file = $upload_path.'/'.$path.'/'.$filename;

            $product->file_path = date('Y-m-d');
            $product->image = $filename;

           endif;

            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = $request->input('content');

            if($product->save()):
                //compruebo si existe un archivo con el name image
                  if($request->hasFile('image')):
                    //si existe, seteo el campo imagen y storeAs Recibe tres parametros, 1)la ruta final, 2)el nombre del archivo,3)carpeta donde se guarda
                    $file = $request->image->storeAs($path, $filename, 'uploads');

                    //crear miniatura de la imagen
                    $img =  Image::make($final_file);
                    
                    $img->fit(256,256,function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                  endif;

                return back()->with('message','Actualizado correctamente')->with('typealert','success');

            endif;
           
        endif;


    }

    public function productGalleryAdd(Request $request, $id){

        $rules = [

            'file_image' => 'required|image'
        ];

        $message = [
            'file_image.required' => 'Debes seleccionar una imagen',
            'file_image.image' => 'El archivo seleccionado no es una imagen'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Ocurrio un error')->with('typealert','danger')->withInput();
        else:
            if($request->hasFile('file_image')):
                //creo la carpeta donde la guardare
                $path = '/'.date('Y-m-d');
                //obtengo la extension del archivo
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                //la ruta donde se guardara y yo accedere al archivo
                $upload_path = Config::get('filesystems.disks.uploads.root');
                //extraigo el nombre de la foto y lo convierto en slug
                $name =  Str::slug(str_replace($fileExt,'',$request->file('file_image')->getClientOriginalName()));
                //nombre del archivo listo para guardarlo
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $gallery = new ProductGallery;
                $gallery->product_id = $id;
                $gallery->file_path = date('Y-m-d');
                $gallery->file_name = $filename;

                if($gallery->save()):
                     if($request->hasFile('file_image')):
                       $file = $request->file_image->storeAs($path,$filename,'uploads');
                       
                       $image = Image::make($final_file);
                       
                       $image->fit(256,256,function($constraint){
                            $constraint->upsize();
                       });
                       $image->save($upload_path.'/'.$path.'/t_'.$filename);
                     endif;
                     return back()->with('message','Imagen agregada correctamente')->with('typealert','success');
                else:
                endif;
                
            else:
               

            endif;
      

        endif;

    }

    public function productGalleryDelete($id , $galleryid){
        $gallery = ProductGallery::findOrFail($galleryid);
        $path = $gallery->file_path;
        $file = $gallery->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if($gallery->product_id != $id):
            return back()->with('message','La imagen no se puede eliminar')->with('typealert','danger');
        else:
            if($gallery->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
                return back()->with('message','Imagen eliminada correctamente')->with('typealert','success');
            endif;
        endif;


    }
}
