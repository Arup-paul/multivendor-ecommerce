<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;

class PaypalController extends Controller
{
    private $gateway;
    public function __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public   function makePayment($amount){
        try {
            $response =  $this->gateway->purchase(array(
                'amount' => $amount ?? 0,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('paypal.success'),
                'cancelUrl' => route('paypal.fail'),
            ))->send();

            if($response->isRedirect()){
                $response->redirect();
            }else{
                $response->getMessage();
            }
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }
    public function success(Request $request){
      if($request->input('paymentId') && $request->input('PayerID')){
          $transaction =  $this->gateway->completePurchase(array(
             'payer_id' => $request->input('PayerID'),
             'transactionReference' => $request->input('paymentId')
          ));

          $response = $transaction->send();

          if($response->isSuccessful()){
              $orderProcess = new OrderService();
              $order =  $orderProcess->orderProcess();

              $session_id = Session::get('session_id');
              Cart::where('user_id',auth()->user()->id)->orWhere('session_id',$session_id)->delete();
              Session::forget('delivery_address');
              Session::forget('payment_gateway');
              Session::forget('payment_method');
              Session::forget('couponAmount');
              Session::forget('couponCode');
              Session::forget('grandTotal');
              Session::forget('total');
              Session::forget('total_weight');
              Session::flash('success', 'Order placed successfully');
              return redirect()->route('order.success',$order->order_id);
          }

      }
    }
    public function fail(){
        Session::flash('error', "Payment failed");
        return redirect()->route('cart');
    }
}
