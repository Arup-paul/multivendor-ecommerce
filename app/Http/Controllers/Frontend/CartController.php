<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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
        $cartItems = Cart::getCartItems();
        return view('frontend.cart.cart',compact('cartItems'));
    }

    public function cartUpdate(Request $request){
        if($request->ajax()){
            $cartDetails = Cart::find($request->cartId);
            $cartItems = Cart::getCartItems();
            $availableSize = ProductAttributes::where(['product_id'=>$cartDetails->product_id,'size'=>$cartDetails->size,'status' => 1])->count();
            if($availableSize  ==  0){
                return response()->json([
                    'status' => false,
                    'message' => __('Product Size is not  available. Please remove this product from cart'),
                    'view' => (String)View::make('frontend.cart.items',compact('cartItems'))->render(),

                ]);
            }

            $productStock = ProductAttributes::isStockAvailable($cartDetails->product_id,$cartDetails->size);
            if($productStock < $request->qty){
                return response()->json([
                    'status' => false,
                    'message' => __('Product Stock is not available'),
                    'view' => (String)View::make('frontend.cart.items',compact('cartItems'))->render(),

                ]);
            }
            $cart = Cart::where('id',$request->cartId)->update(['quantity'=>$request->qty]);
            $cartItems = Cart::getCartItems();
            return response()->json([
               'status' => true,
               'view' => (String)View::make('frontend.cart.items',compact('cartItems'))->render(),
            ]);

        }

    }

    public function removeItem(Request $request){
        if($request->ajax()){
             Cart::where('id',$request->cartId)->delete();
            $cartItems = Cart::getCartItems();
            return response()->json([
                'status' => true,
                'message' => 'Product removed from cart successfully',
                'view' => (String)View::make('frontend.cart.items',compact('cartItems'))->render(),
            ]);

        }

    }

}
