<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator,Hash,Auth;
use App\User;

class UserController extends Controller
{

    public function __construct(){
        //cualquier metodo o funcion que se use requiere que el usuario no este con la sesion iniciada , excepto los metodos que si se peude acceder
        $this->middleware('guest')->except(['logout']);
    }

    public function login(){

        return view('user.login');

    }

    public function authenticate(Request $request){

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'

        ];

        $messages = [
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es inválido.',
            'password.required' => 'Por favor ingrese su contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()):
            //con withErros extraigo los errores de $validator
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');
        else:

            $email = $request->input('email');
            $password = $request->input('password');

            //attemp realiza la autenticacion y recibe un arreglo con los parametros a autenticar y el ultimo parametro decidimos si el usuario permanecera conectado
             if(Auth::attempt(['email' => $email, 'password' => $password],true)):

                return redirect('/');
             else:
                return back()->with('message','Correo electrónico o contraseña erronea')->with('typealert','danger');
             endif;

        endif;

    }

    public function register(){

        return view('user.register');

    }

    public function create(Request $request){

        //validar
       
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es inválido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' => 'Por favor ingrese una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'cpassword.required' => 'Es necesario confirmar la contraseña.',
            'cpassword.min' => 'La confirmacion de la contraseña debe tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseñas no coinciden.'
            
        ];

        //la clase validator usando el metodo make que recibe ciertos parametros
        //para validar le paso  dos parametros 1) el objeto de $request que es la info del todo el formulario
        //2) las reglas de validacion 3)la variable de los mensajes

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()):
            //con withErros extraigo los errores de $validator
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');
        else:
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password =  Hash::make(e($request->input('password')));
            $user->role ='user';

            if($user->save()): 

                 return redirect('/login')->with('message','Su usuario se creo correctamente, debe iniciar sesion')->with('typealert','success');
            endif;
        endif;
        
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    
}
