<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ratings;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(){
        $reviews = Ratings::withWhereHas('product', function($q){
            $q->select(['id','product_name','slug']);
        })->where('user_id',auth()->id())->get();
       return view('frontend.user.review.index',compact('reviews'));
    }

    public function store(Request $request){
        $request->validate([
            'rating' => 'required'
        ]);

        $rating = new Ratings();
        $rating->product_id = $request->input('product_id');
        $rating->user_id = auth()->user()->id;
        $rating->rating = $request->input('rating');
        $rating->review = $request->input('review');
        $rating->status = 1;
        $rating->save();
        return response()->json( [ 'message' =>  'Submit Your Rating successfully'] );
    }


}
