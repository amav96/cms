@extends('admin.master')

@section('title','Agregar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products/add') }}"><i class="fas fa-plus"></i> Agregar producto</a>
</li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-plus"></i> Agregar producto</h2>
        </div>

        <div class="inside">

            <form method="POST" action=" ">
                @csrf

                <div class="row">

                    <div class="col-md-6">
                        <label for="name">Nombre del producto : </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="category">Categoría: </label>
                        <select class="custom-select" name="category" id="">
                            <option value="">Seleccione categoria</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="image">Imagen </label>
                        <div class="custom-file">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mtop16">
                    <div class="col-md-3">
                        <label for="price">Precio :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="fas fa-dollar-sign"></i></span>
                            </div>

                            <input type="number" class="form-control">
                        </div>
                    </div>



                    <div class="col-md-3">
                        <label for="indiscount">¿En descuento?</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="fas fa-dollar-sign"></i></span>
                            </div>
                            <select class="custom-select" name="indiscount">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <label for="discount">Descuento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" class="form-control" name="discount">
                        </div>

                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        <label for="content">Decripción</label>
                        <textarea name="content" class="form-control" id="editor"></textarea>
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Crear producto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection