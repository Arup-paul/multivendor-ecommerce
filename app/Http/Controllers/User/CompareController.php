<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    public function index(){
              $compares = Compare::with(['product' => fn($query) =>
        $query->select(['id','product_name','slug','product_image','product_price','product_color','product_discount','description','category_id','brand_id']),'product.brand','product.category','product.attributes'])->get();
        return view('frontend.user.compare.index',compact('compares'));
    }
    public function compare(Request $request){
        $product_id = $request->input('product_id');
        $sessionId = Session::get('session_id');

        $count = Compare::where('product_id',$product_id)->where('session_id',$sessionId)->count();

        if($count > 0){
            return response()->json(__('This Product Already Added To Compare'), 422);
        }

        $totalCompare = Compare::where('session_id',$sessionId)->count();
        if($totalCompare == 2){
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


    public function destroy(Request $request){
        Compare::where('id',$request->input('id'))->delete();
        return response()->json([
            'message' => 'Successfully Removed From Compare',
            'redirect' => url()->previous()
        ]);
    }
}
