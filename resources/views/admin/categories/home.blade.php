@extends('admin.master')

@section('title','Categorias')

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
                    <h2 class="title"><i class="fas fa-plus"></i> Agregar Categorias</h2>
                </div>
                <div class="inside">
                    <form method="POST" action="{{ url('/admin/category/create') }}">
                        @csrf

                        <label for="name">Nombre : </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <label class="mtop16" for="module">Módulo : </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            <select class="custom-select" name="module" id="">
                                @foreach(getModulesArray() as $indice => $key)
                                <option value="{{$indice}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="mtop16" for="icon">Ícono : </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            <input type="text" name="icon" class="form-control">
                        </div>

                        <div class="input-group mtop16">
                            <button class="btn btn-success" type="submit"> Guardar </button>
                        </div>



                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far fa-folder-open"></i> Categorias</a></h2>
                </div>
                <div class="inside">

                    <nav class="nav nav-pills nav-fill">
                        @foreach(getModulesArray() as $module => $key )
                        <a class="nav-link" href=" {{ url('/admin/categories/'.$module) }} "><i class="fas fa-list"></i>
                            {{$key}} </a>
                        @endforeach
                    </nav>

                    <table class="table mtop16">
                        <thead>
                            <tr>
                                <td width=32></td>
                                <td>Nombre</td>
                                <td width=140></td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category )

                            <tr>
                                <td>{!! htmlspecialchars_decode($category->icon) !!}</td>

                                <td>{{$category->name}}</td>
                                <td>
                                    <div class="opts">
                                        <a href=" {{ url('/admin/category/'.$category->id.'/edit') }} "
                                            data-toggle="tooltip" data-placement="top" title="Editar"><i
                                                class="fas fa-edit"></i></a>
                                        <a href=" {{ url('/admin/category/'.$category->id.'/delete') }} "
                                            data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>

                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection