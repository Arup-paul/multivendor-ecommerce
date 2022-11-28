<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function cartAdd(Request $request)
    {
        $request->validate([
            'size' => 'required',
            'qty' => 'required',
        ]);

        $productStock = ProductAttributes::isStockAvailable($request->product_id, $request->size);

        if ($productStock < $request->qty) {
            return response()->json(__('quantity is not available'), 422);
        }

        //session
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = Session::get('session_id');
            Session::put('session_id', $session_id);
        }
        //check product is already exist
        if (auth()->check()) {
            $countProducts = Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $request->product_id)
                            ->orWhere('session_id',$session_id)
                            ->where('size', $request->size)
                            ->count();
            if ($countProducts > 0) {
                return response()->json(__('product is already exist'), 422);
            }
        } else {
            $countProducts = Cart::where(['product_id' => $request->product_id, 'size' => $request->size, 'session_id' => $session_id])->count();
            if ($countProducts > 0) {
                return response()->json(__('product is already exist'), 422);
            }
        }


        $cart = new Cart();
        $cart->session_id = $session_id;
        if (auth()->check()) {
            $cart->user_id = auth()->user()->id;
        }

        $cart->product_id = $request->product_id;
        $cart->size = $request->size;
        $cart->quantity = $request->qty;
        $cart->save();

        return response()->json(['message' => __('Product added to cart successfully')]);

    }

    public function cart()
    {
        $cartItems = Cart::getCartItems();
        return view('frontend.cart.cart', compact('cartItems'));
    }

    public function cartUpdate(Request $request)
    {
        if ($request->ajax()) {
            $cartDetails = Cart::find($request->cartId);
            $cartItems = Cart::getCartItems();
            $availableSize = ProductAttributes::where(['product_id' => $cartDetails->product_id, 'size' => $cartDetails->size, 'status' => 1])->count();
            if ($availableSize == 0) {
                return response()->json([
                    'status' => false,
                    'message' => __('Product Size is not  available. Please remove this product from cart'),
                    'view' => (string)View::make('frontend.cart.items', compact('cartItems'))->render(),

                ]);
            }

            $productStock = ProductAttributes::isStockAvailable($cartDetails->product_id, $cartDetails->size);
            if ($productStock < $request->qty) {
                return response()->json([
                    'status' => false,
                    'message' => __('Product Stock is not available'),
                    'view' => (string)View::make('frontend.cart.items', compact('cartItems'))->render(),

                ]);
            }
            $cart = Cart::where('id', $request->cartId)->update(['quantity' => $request->qty]);
            $cartItems = Cart::getCartItems();
            return response()->json([
                'status' => true,
                'view' => (string)View::make('frontend.cart.items', compact('cartItems'))->render(),
            ]);

        }

    }

    public function removeItem(Request $request)
    {
        if ($request->ajax()) {
            Cart::where('id', $request->cartId)->delete();
            $cartItems = Cart::getCartItems();
            return response()->json([
                'status' => true,
                'message' => 'Product removed from cart successfully',
                'view' => (string)View::make('frontend.cart.items', compact('cartItems'))->render(),
            ]);

        }

    }

    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $code = $request->input('code');
            $count = Coupon::where('coupon_code', $code)->count();
            if ($count == 0) {
                return response()->json([
                    'invalid_coupon' => 'This Coupon Code is not valid'
                ]);
            } else {
                $couponDetails = Coupon::where('coupon_code', $code)->first();
                if ($couponDetails->status == 0) {
                    return response()->json([
                        'invalid_coupon' => 'This Coupon Code is not active'
                    ]);
                }
                //check coupon is not started
                $start_date = $couponDetails->start_date;
                $current_date = date('Y-m-d');
                if ($start_date > $current_date) {
                    return response()->json([
                        'invalid_coupon' => 'This Coupon Code is not valid now'
                    ]);
                }

                //check coupon is expired
                $expiry_date = $couponDetails->end_date;
                $current_date = date('Y-m-d');
                if($expiry_date < $current_date){
                    return response()->json([
                        'invalid_coupon' => 'This Coupon Code is expired'
                    ]);
                }

                //check if category is selected
                $session_id = Session::get('session_id');
                if($couponDetails->	categories != null){
                     $categoryIds = explode(',',$couponDetails->categories);
                     $countCategory = Cart::where('user_id',auth()->user()->id)
                         ->orWhere('session_id',$session_id)
                          ->whereHas('product',function($query) use($categoryIds){
                              $query->whereIn('category_id',$categoryIds);
                          })->count();
                            if($countCategory == 0){
                                return response()->json([
                                    'invalid_coupon' => 'This Coupon Code is not valid for this category'
                                ]);
                            }
               }else{
                    return response()->json([
                        'invalid_coupon' => 'This Coupon Code is not valid for this category'
                    ]);
                }

                //check if user is selected
                if($couponDetails->users != null){
                    $userIds = explode(',',$couponDetails->users);
                    if(!in_array(auth()->user()->id,$userIds)){
                        return response()->json([
                            'invalid_coupon' => 'This Coupon Code is not valid for you'
                        ]);
                    }
                }else{
                    return response()->json([
                        'invalid_coupon' => 'This Coupon Code is not valid for you'
                    ]);
                }

                //product total amount
                $cartItems = Cart::getCartItems();
                $total = 0;
                foreach ($cartItems as $item){
                    $discount = Product::getDiscountPrice($item->product_id);

                    if($discount != 0){
                        $total += $discount * $item->quantity;
                    }else{
                        $total += $item->product->product_price * $item->quantity;
                    }
                }


                //check coupon amount type
                if($couponDetails->amount_type == 'Fixed'){
                    $couponAmount = $couponDetails->amount;
                }else{
                    $couponAmount = $total * ($couponDetails->amount/100);
                }
                $grandTotal = $total - $couponAmount;

                Session::put('couponAmount',$couponAmount);
                Session::put('grandTotal',$grandTotal);
                Session::put('couponCode',$code);

                return response()->json([
                    'status' => true,
                    'message' => 'Coupon Code is successfully applied',
                    'view' => (string)View::make('frontend.cart.items', compact('cartItems'))->render(),
                ]);
            }
        }
    }
}






