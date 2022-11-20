<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartAdd(Request $request){
          $request->validate([
              'size' => 'required',
              'qty' => 'required',
          ]);

          $productStock = ProductAttributes::isStockAvailable($request->product_id,$request->size);

          if($productStock < $request->qty){
              return  response()->json(   __('quantity is not available'),422 );
          }

          //session
           $session_id = Session::get('session_id');
              if(empty($session_id)){
                $session_id = Session::get('session_id');
                Session::put('session_id',$session_id);
           }
           //check product is already exist
             if(auth()->check()){
                    $countProducts = Cart::where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->where('size',$request->size)->count();
                     if($countProducts > 0){
                         return  response()->json(   __('product is already exist'),422 );
                     }
             }else{
                $countProducts = Cart::where(['product_id'=>$request->product_id,'size'=>$request->size,'session_id'=>$session_id])->count();
                if($countProducts > 0){
                    return  response()->json(   __('product is already exist'),422 );
                }
             }



           $cart = new Cart();
           $cart->session_id = $session_id;
//           $cart->user_id = auth()->user()->id;
           $cart->product_id = $request->product_id;
           $cart->size = $request->size;
           $cart->quantity = $request->qty;
           $cart->save();

           return response()->json( [ 'message' =>  __('Product added to cart successfully') ] );

    }

    public function cart(){
        return view('frontend.cart.cart');
    }
}
