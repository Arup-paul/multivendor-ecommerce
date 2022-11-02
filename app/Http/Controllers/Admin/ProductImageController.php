<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function create($id){
        $product = Product::select(['id','product_name','product_code','product_color','product_image','product_price'])
            ->where('id',$id)->first();
        $product->setRelation('images',$product->images()->paginate(5));
        return view('admin.product-image.images',compact( 'product'));
    }

    public function store(Request $request){
        $request->validate([
            'product_image' => 'required',
        ]);
            $productImage = new ProductImage();
            $productImage->product_id = $request->product_id;
            $productImage->image = $request->product_image;
            $productImage->save();

            return response()->json([
                'message' => 'New Product Image Added Successfully',
                'redirect' => route('admin.product-images.create',$productImage->product_id)
            ]);


    }
    public function update(Request $request){
        foreach ($request->input('id') as $key => $value) {
            $productImage = ProductImage::find($value);
            $productImage->product_id = $request->product_id;
            $productImage->status = $request->status[$key];
            $productImage->save();
        }

        return response()->json( [ 'message' =>  'Status Updated  successfully'] );


    }
}
