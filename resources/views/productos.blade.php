@extends('template')
@section('content')
    <div class="row">
    @foreach($model as $m)
        <div class="col-md-4 container">

                <h3>{{$m->nombre}}</h3>
                <img src="{{$m->imagen}}" width="100"/>
                <div class="contai">
                    <p>{{$m->extracto}}</p>
                    <p>Precio {{ number_format($m->precio,2)}}</p>
                    <p>
                        <a href="{{route('cart-add',$m->slug)}}" class="btn btn-success">Añadir al Carrito</a>
                        <a href="{{ route('producto_detalle',$m->slug) }}" class="btn btn-primary">Ver mas Detalle</a>
                    </p>
                </div>
        </div>

    @endforeach
    </div>
@stop