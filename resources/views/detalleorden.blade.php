@extends('template')
@section('content')
    <div class="container text-center">
        <div class="page-header">
            <h1>
        Detalle del Pedido!
            </h1>
        </div>
        <div class="page">
            <div class="table-responsive">
                <h3>Datos del Cliente</h3>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <td><b>Nombre:</b></td><td>{{Auth::user()->name." ".Auth::user()->apellido }}</td>
                    </tr>
                    <tr>
                        <td><b>Usuario:</b></td><td>{{Auth::user()->user }}</td>
                    </tr>
                    <tr>
                        <td><b>Correo:</b></td><td>{{Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Direccion:</b></td><td>{{Auth::user()->direccion }}</td>
                    </tr>


                </table>
            </div>
            <div class="table-responsive">
                <h3>Datos del Pedido</h3>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                    @foreach($model as $m)
                        <tr>
                            <td>{{$m->nombre}}</td>
                            <td>{{number_format($m->precio,2)}}</td>
                            <td>{{$m->cantidad}}</td>
                            <td>{{number_format($m->precio*$m->cantidad,2)}}</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
                <h3><span class="btn btn-success">Total: ${{ number_format( $total,2)}}</span></h3>
                <hr>
                <p><a href="{{route('cart-show')}}"class="btn btn-outline-danger">Regresar</a>
                    <a href="" class="btn btn-outline-secondary">Pagar con Paypal</a></p>
            </div>
        </div>



    </div>
@stop