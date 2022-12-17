<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ratings;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function index(){
        $reviews = Ratings::withWhereHas('product', function($q){
                $q->select(['id','product_name','product_image']);
            })->withWhereHas('user', function($q){
                $q->select(['id','name']);
            })->paginate(10);

        return view('admin.ratings.index',compact('reviews'));

    }

    public function edit($id){
        $review = Ratings::withWhereHas('product', function($q){
            $q->select(['id','product_name']);
        })->where('id',$id)->first();

        return view('admin.ratings.edit',compact('review'));
    }

    public function update(Request $request,$id){
        $request->validate([
           'rating' => 'required'
        ]);

        $review = Ratings::findOrFail($id);
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->status = $request->status;
        $review->save();
        return response()->json( [ 'message' =>  'Review Rating Updated successfully'] );


    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $slider = Ratings::findOrFail($id);
                    if(file_exists($slider->banner)){
                        unlink($slider->banner);
                    }
                    if(file_exists($slider->child_image)){
                        unlink($slider->child_image);
                    }
                    $slider->delete();
                }
                return response()->json([
                    'message' =>  __('Rating Deleted Successfully'),
                    'redirect' => route('admin.sliders.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }

    }
}
