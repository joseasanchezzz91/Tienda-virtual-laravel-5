@extends('template')
@section('content')
    <div class="container table-responsive">
        <h2>Carro de compras</h2>
        <p>T</p>
        @if($model)
            <div class="container"><a href="{{route('borrar')}}"class="btn btn-danger">Vaciar carrito</a></div>

            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Modificar</th>
                    <th>SubTotal</th>
                    <th>Quitar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($model as $m)
                    <tr>
                    <td ><img src="{{$m['imagen']}}" width="50"></td>
                    <td>{{$m['nombre']}}</td>
                    <td>{{$m['precio']}}</td>
                    <td>{{$m['cantidad']}}</td>
                    <td ><a href="{{route('cart-mas',[$m->slug])}}" class="btn btn-primary">+</a> <a href="{{route('cart-menos',[$m->slug])}}" class="btn btn-warning">-</a></td>
                    <td>{{number_format($m['precio']*$m['cantidad'],2 )}}</td>
                    <td><a href="{{route('cart-delete',[$m['slug']])}}" class="btn btn-outline-danger">quitar</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <h2>el  monto a pagar es: <span style="color:green;">${{$total}}</span></h2>
       @else
        <h2>No hay item en el carrito</h2>
       @endif
        <div class="row">
            <div class="container-fluid"><a href="/index" class="btn btn-outline-danger">Regresar</a>
          <a href="" class="btn btn-outline-primary">Continuar</a></div>
        </div>
    </div>
@stop