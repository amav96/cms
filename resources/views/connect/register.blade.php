@extends('connect.master')

@section('title','Registrarse')


@section('content')


<div class="d-flex  justify-content-md-center cont">
    <div class="box box_register shadow col col-lg-4">
        <div class="header">
            <a href="">
                <img src="{{ url('/static/images/logo/logo.png') }}" alt="">
            </a>

        </div>
        <div class="inside">
            <form method="POST" action="{{ route('register') }} ">

                @csrf

                <label for="name">Nombre</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    <input class="form-control" type="text" name="name">
                </div>

                <label for="lastname" class="mtop16">Apellido</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user-tag"></i></div>
                    </div>
                    <input class="form-control" type="text" name="lastname">
                </div>


                <label for="email" class="mtop16">Correo Electrónico</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                    </div>
                    <input class="form-control" type="email" name="email">
                </div>

                <label for="password" class="mtop16">Contraseña</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input class="form-control" type="password" name="password">
                </div>

                <label for="confirmar_password" class="mtop16">Confirmar contraseña</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input class="form-control" type="password" name="cpassword">
                </div>

                <div class="form-group mtop16">
                    <input class="btn btn-success" value="Registrarse">
                </div>

            </form>
        </div>
        <div class="mtop16 footer">
            <a href="{{ url('/login') }}">Ya tengo una cuenta, ingresar</a>

        </div>
    </div>

</div>


@stop