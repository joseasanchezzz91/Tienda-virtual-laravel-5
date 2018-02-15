@extends('template')
@section('content')
    <div class="row container-fluid">

        <div class="col-md-6 col-lg-6">
            <h1>Detalle del Producto</h1>
            <img src="{{ $model->imagen}}" width="250" >
        </div>
        <div class="col-md-6 col-lg-6 right">
            <h3>{{$model->nombre}}</h3>
            <p>{{$model->descripcion}}</p>
            <div class="row">
                <div class="col-md-4"><p class=" btn btn-success ">Precio: ${{number_format($model->precio,2)}}</p></div>
                <div class="col-md-4"> <a href="{{route('cart-add',$model->slug)}}"class="btn btn-primary">Añadir al carrito</a></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container center-block"> <a href="{{url('/index')}}" class="btn btn-outline-warning" >Regresar</a></div>














@stop