<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
class PaymentController extends Controller
{   protected $customer;
    public function __construct()
    {



    }
   public function index(){
       return view('payment');

   }
    public  function pay(){
        Stripe::setApiKey(config('services.stripe.secret'));
        $customer = \Stripe\Customer::create(array(
            "email" => request('stripeEmail'),
            "source" => request('stripeToken')
        ));
        $this->customer=$customer;
        $charge = \Stripe\Charge::create(array(
            "amount" => 2500,
            "currency" => "cad",
            "customer"=>$customer->id
        ));
        return "done";
    }
}
