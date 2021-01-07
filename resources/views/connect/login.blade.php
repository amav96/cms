@extends('connect.master')

@section('title','Login')


@section('content')


<div class="d-flex  justify-content-md-center cont">
    <div class="box box_login shadow col col-lg-4">
        <div class="header">
            <a href="">
                <img src="{{ url('/static/images/logo/logo.png') }}" alt="">
            </a>

        </div>
        <div class="inside">
            <form method="POST" action="{{ route('login') }} ">

                @csrf
                <label for="email">Correo Electrónico</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                    </div>
                    <input class="form-control" type="email" name="email">
                </div>

                <label for="email" class="mtop16">Contraseña</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input class="form-control" type="password" name="password">
                </div>

                <div class="form-group mtop16">
                    <input class="btn btn-success" value="Ingresar">
                </div>

            </form>
        </div>
        <div class="mtop16 footer">
            <a href="{{ url('/register') }}">¿No tienes una cuenta? Registrate</a>
            <a href="{{ url('/recover') }}">Recuperar contraseña</a>
        </div>
    </div>

</div>


@stop