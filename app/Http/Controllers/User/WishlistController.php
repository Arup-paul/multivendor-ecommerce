<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){
         $wishlists = Wishlist::with(['product' => fn($query) =>
              $query->select(['id','product_name','slug','product_image','product_price']),
           'product.attributes'   => fn($query) => $query->select(['id','product_id','stock','size'])])
           ->where('user_id',auth()->id())->get();
        return view('frontend.user.wishlist.index',compact('wishlists'));
    }
    public function addWishlist(Request $request){
        if(!auth()->check()){
            return response([
                'redirect' => route('login')
            ]);
        }
        $product_id = $request->input('product_id');
        $userId = auth()->id();

        $wishlistCount = Wishlist::where('product_id',$product_id)->where('user_id',$userId)->count();

        if($wishlistCount > 0){
            return response()->json(__('Already Added To Wishlist'), 422);
        }

        Wishlist::create([
            'product_id' => $product_id,
            'user_id'  => $userId
        ]);

        return response()->json([
            'total_wish_list' => total_wishlist_items(),
            'message' => __('Successfully Added To The Wishlist'),
        ]);
    }

    public function destroy(Request $request){
        Wishlist::where('id',$request->input('wishlistId'))->delete();
        return response()->json([
            'message' => 'Successfully Removed From Wishlist',
            'redirect' => url()->previous()
        ]);
    }

    public function massDestroy(){
        Wishlist::query()->where('user_id',auth()->id())->delete();
        return response()->json([
            'message' => 'Successfully Removed From Wishlist',
            'redirect' => url()->previous()
        ]);

    }
}
