<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;



class CartController extends Controller
{
public  function __construct()
{
    if(!\Session::has('car')){
        \Session::put('car',array());
    }

}


    public function show(){
       $model= \Session::get('car');
       $total=$this->total();
        return view('cart',['model'=>$model,'total'=>$total]);
    }

    public function add(Producto $producto){
        $cart= \Session::get('car');
        $producto->cantidad=1;
        $cart[$producto->slug]=$producto;
        \Session::put('car',$cart);
        return redirect()->route('cart-show');
    }

    public function delete(Producto $producto)
    {
        $cart = \Session::get('car');
        unset($cart[$producto->slug]);

        \Session::put('car',$cart);
        return redirect()->route('cart-show');
    }
public function borrar(){
        \Session::forget('car');
    return redirect()->route('cart-show');
}
public function mas(Producto $producto){
    $cart=\Session::get('car');
    $cant=1+$cart[$producto->slug]->cantidad;
    $cart[$producto->slug]->cantidad=$cant;
    \Session::put('car',$cart);
    return redirect()->route('cart-show');
}
    public function menos(Producto $producto){
        $cart=\Session::get('car');
        if (($cart[$producto->slug]->cantidad) >1){
        $cant=$cart[$producto->slug]->cantidad-1;
        $cart[$producto->slug]->cantidad=$cant;
        \Session::put('car',$cart);}
        return redirect()->route('cart-show');
    }
    public function total(){
        $cart=\Session::get('car');
       $total=0;
       foreach ($cart as $c){
        $total+= $c->precio* $c->cantidad;
       }

        return $total;
    }

    public function ordendetalle(){
        if(count(\Session::get('car')) <= 0){
            return redirect()->route('index');
        }
        $model=\Session::get('car');
        $total= $this->total();
        return view('detalleorden',['model'=>$model,'total'=>$total]);
    }



}
