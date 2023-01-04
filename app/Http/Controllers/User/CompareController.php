<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    public function index(){
        $wishlists = Compare::with(['product' => fn($query) =>
        $query->select(['id','product_name','slug','product_image','product_price']),
            'product.attributes'   => fn($query) => $query->select(['id','product_id','stock','size'])])->get();
        return view('frontend.user.compare.index',compact('wishlists'));
    }
    public function compare(Request $request){
        $product_id = $request->input('product_id');
        $sessionId = Session::get('session_id');

        $count = Compare::where('product_id',$product_id)->where('session_id',$sessionId)->count();

        if($count > 0){
            return response()->json(__('This Product Already Added To Compare'), 422);
        }

        $totalCompare = Compare::where('session_id',$sessionId)->count();
        if($totalCompare > 2){
            return response()->json(__('Already Added 2  Compare Product'), 422);
        }

        Compare::create([
            'product_id' => $product_id,
            'session_id'  => $sessionId
        ]);

        return response()->json([
            'message' => __('Compare Added Successfully'),
        ]);
    }
}
