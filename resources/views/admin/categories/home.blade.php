@extends('admin.master')

@section('title','Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/categories') }}"><i class="fas fa-boxes"></i> Categorias</a>
</li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-folder"></i> Categorias</h2>
        </div>

        <div class="inside">

            <div class="btns">
                <a href="{{ url('/admin/category/add') }}" class="btn btn-primary"><i class="fas fa-folder"></i> Agregar
                    Categoria</a>
            </div>


            <table class="table">

            </table>
        </div>
    </div>
</div>

@endsection