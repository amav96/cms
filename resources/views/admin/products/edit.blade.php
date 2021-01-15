@extends('admin.master')

@section('title','Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products/create') }}"><i class="far fa-edit"></i> Editar producto</a>
</li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far fa-edit"></i> Editar producto</h2>
                </div>

                <div class="inside">

                    <form method="POST" enctype="multipart/form-data"
                        action="{{ url('/admin/product/'.$product->id.'/update') }}">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <label for="name">Nombre del producto : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="far fa-keyboard"></i></span>
                                    </div>
                                    <input type="text" value="{{ $product->name}}" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="category">Categoría: </label>
                                <select class="custom-select" name="category" id="">
                                    @foreach($categories as $key => $value )
                                    <option value="{{$key}}" @if($product->category_id === $key) selected
                                        @endif>{{$value}}
                                    </option>
                                    @endforeach


                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="image">Imagen </label>
                                <div class="custom-file">
                                    <div class="custom-file">
                                        <input name="image" type="file" accept="image/*" class="custom-file-input"
                                            id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
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

                                    <input type="number" value="{{ $product->price}}" name="price" class="form-control">
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
                                    <input type="number" value="{{ $product->discount}}" class="form-control"
                                        name="discount">
                                </div>

                            </div>

                            <div class="col-md-3">
                                <label for="status">Estado</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-truck"></i></span>
                                    </div>
                                    <select class="custom-select" name="status">
                                        @if($product->status === 0)
                                        <option value="0">Borrador</option>
                                        <option value="1">Público</option>
                                        @elseif($product->status === 1)
                                        <option value="1">Público</option>
                                        <option value="0">Borrador</option>
                                        @endif


                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="content">Decripción</label>
                                <textarea name="content" class="form-control"
                                    id="editor">{{ $product->content}}</textarea>
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
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-image"></i> Imagen destacada</h2>
                </div>
                <div class="inside">
                    <img src="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}" class="img-fluid mtop16">
                </div>
            </div>

            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="far fa-images"></i> Galeria</h2>
                </div>
                <div class="inside product_gallery">
                    <form method="POST" action="{{ url('/admin/product/'.$product->id.'/gallery/add') }}"
                        enctype="multipart/form-data" id="form_product_gallery">
                        @csrf
                        <input class="form-control" style="display:none" type="file" name="file_image"
                            id="product_file_image" accept="image/*" required>
                    </form>
                    <div class="btn-submit">
                        <a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                    </div>

                    <div class="tumbs">
                        @foreach($product->getGallery as $image)


                        <div class="tumb">
                            <a href=" {{ url('admin/product/'.$product->id.'/gallery/'.$image->id.'/delete') }} "
                                data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                    class="fas fa-trash-alt"></i>
                            </a>
                            <img src="{{ url('/uploads/'.$image->file_path.'/t_'.$image->file_name) }}" alt="">

                        </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection