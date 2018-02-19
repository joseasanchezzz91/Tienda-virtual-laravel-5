<?php

namespace App\Http\Controllers;


use Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\OrdenItem;
use App\Orden;

class PaypalController extends Controller
{
    private $api_context;

    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');
        $this->api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->api_context->setConfig($paypal_conf['settings']);
    }



    public function postPayment(){
        $payer= new Payer();
        $payer->setPaymentMethod('paypal');

        $items=array();
        $subtotal=0;
        $cart= Session::get('car');
        $currency= 'USD';

        foreach ($cart as $car){
            $item = new Item();
            $item->setName($car->nombre)
                ->setCurrency($currency)
                ->setDescription($car->extracto)
                ->setQuantity($car->cantidad)
                ->setPrice($car->precio);
            $items[]= $item;
            $subtotal+= $car->cantidad*$car->precio;
        }
        $item_list=new ItemList();
        $item_list->setItems($items);


        $detalle=new Details();
        $detalle->setSubtotal($subtotal)
            ->setShipping(100);

        $total=$subtotal+100;

        $monto=new Amount();
        $monto->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($detalle);

        $transaction= new Transaction();
        $transaction->setAmount($monto)
                    ->setItemList($item_list)
                    ->setDescription("Pedido de prueba de mi tienda hecha con laravel");

        $redirec_url=new RedirectUrls();
        $redirec_url->setReturnUrl(URL::route('payment.status'))
                    ->setCancelUrl(URL::route('payment.status'));


        $payment=new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirec_url)
                ->setTransactions(array($transaction));


        try{
                $payment->create($this->api_context);



        }
        catch (\Paypal\Exception\PPConnectionException $ex){
            if(\Config::get('app.debug')){
                echo "ERROR no creo el api_context:" . $ex->getMessage().PHP_EOL;
                $error_data=json_decode($ex->getData(),true);
                exit();
            }else{
                die("ups! Algo salio mal");
            }

        }

        foreach ($payment->getLinks() as $link){
            if($link->getRel()=='approval_url'){
                $redirec_url=$link->getHref();
                break;
            }
        }
        \Session::put('paypal_payment_id',$payment->getId());


        if (isset($redirec_url)){
            return \Redirect::away($redirec_url);
        }
        return \Redirect::route('cart-show')->with('error','ups error desconocido');



    }





        /////////////////////////////////////////////////////////////////////////////////////////
        public function getPaymentStatus()
        {
            /** Get the payment ID before session clear **/



            /** clear the session payment ID **/
            Session::forget('paypal_payment_id');
            if ( empty(Request::get('token'))) {
                \Session::put('error','Payment failed');

                return Redirect::route('index')->with('message','hubo un problema al intentar pagar con PAYPAL');
            }
            $execution = new PaymentExecution();
            $payment_id = Request::get('paymentId');

            /** PaymentExecution object includes information necessary **/
            /** to execute a PayPal account payment. **/
            /** The payer_id is added to the request query parameters **/
            /** when the user is redirected from paypal back to your site **/

            $execution->setPayerId(Request::get('PayerID'));
            /**Execute the payment **/
            $payment = Payment::get($payment_id, $this->api_context);
            $result = $payment->execute($execution, $this->api_context);
            /** dd($result);exit; /** DEBUG RESULT, remove it later **/
            if ($result->getState() == 'approved') {

                $this->saveOrden();
                \Session::forget('car');
                return \Redirect::route('index')->with('message','Compra realizada con exito');
            }
            \Session::put('error','Payment failed');

            return Redirect::route('index')->with('message','La Compra fue cancelada ');
        }
  //////////////////////////////////////////////////////////////////////////////





    protected function saveOrden(){
        $subtotal=0;
        $cart=\Session::get('car');
        $shipping=100;

        foreach ($cart as $car){
            $subtotal += $car->cantidad*$car->precio;
        }

       $orden =  Orden::create([
            'subtotal'=>$subtotal,
            'envio'=>$shipping,
            'user_id'=> \Auth::user()->id
        ]);


       /*$orden=new Orden;

       $orden->subtotal=$subtotal;
       $orden->envio=$shipping;
       $orden->user_id=\Auth::user()->id;
       $orden->save();*/
        foreach ($cart as $car){
            $this->saveOrdenItem($car,$orden->id);
        }



    }

    protected function saveOrdenItem($producto,$orden_id){
        OrdenItem::create([
            'precio'=>$producto->precio,
            'cantidad'=>$producto->cantidad,
            'producto_id'=>$producto->id,
            'orden_id'=>$orden_id
        ]);

    }
}
