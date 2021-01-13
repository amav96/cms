@extends('admin.master')

@section('title','Editar')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/categories') }}"><i class="far fa-folder-open"></i> Categorias</a>
</li>
@endsection


@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i> Editar Categoria</h2>
                </div>
                <div class="inside">
                    <form method="POST" action="{{ url('/admin/category/'.$category->id.'/update') }}">
                        @csrf

                        <label for="name">Nombre : </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control">
                        </div>

                        <label class="mtop16" for="module">Módulo : </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            <select class="custom-select" name="module" id="">
                                @foreach(getModulesArray() as $indice => $key)
                                <option value="{{$indice}}" @if($indice == $category->module) selected @endif >{{$key}}</option>
                                @endforeach
                            </select>
                           
                        </div>

                        <label class="mtop16" for="icon">Ícono : </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            <input type="text" name="icon" value="{{ $category->icon }}" class="form-control">
                        </div>

                        <div class="input-group mtop16">
                            <button class="btn btn-success" type="submit"> Guardar </button>
                        </div>



                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection