<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;
    protected $guarded= [];

    public static function getCartItems(){
        $session_id = Session::get('session_id');
        if(auth()->check()){
            $cartItems = Cart::with('product')->orderByDesc('id')
                ->where('user_id',auth()->user()->id)
                ->orWhere('session_id',$session_id)
                ->get();

        }else{
            $cartItems = Cart::with('product')->orderByDesc('id')->where('session_id',$session_id)->get();
        }
        return $cartItems;
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id')->select('id','product_name','product_image','product_price','product_code','product_color','category_id','slug');
    }

}
