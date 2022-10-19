<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
     public function create($id){
         $product = Product::select(['id','product_name','product_code','product_color','product_image','product_price'])
             ->where('id',$id)->first();
         $product->setRelation('attributes',$product->attributes()->paginate(10));
         return view('admin.product-attribute.attribute',compact( 'product'));
     }

     public function store(Request $request){

         $request->validate([
             'sku' => 'required|array',
             'sku.*' => 'required|sometimes',
             'price' => 'required|array',
             'price.*' => 'required|sometimes',
             'stock' => 'required|array',
             'stock.*' => 'required|sometimes',
             'size' => 'required|array',
             'size.*' => 'required|sometimes',
         ]);

         foreach ($request->input('sku') as $key => $value) {
             $productAttribute = new ProductAttributes();
             $productAttribute->product_id = $request->product_id;
             $productAttribute->sku = $value;
             $productAttribute->size = $request->size[$key];
             $productAttribute->price = $request->price[$key];
             $productAttribute->stock = $request->stock[$key];
             $productAttribute->save();
         }

         return response()->json( [ 'message' =>  'Product Attribute created successfully'] );
     }

     public function update(Request $request){
         $request->validate([
             'sku' => 'required|array',
             'sku.*' => 'required|sometimes',
             'price' => 'required|array',
             'price.*' => 'required|sometimes',
             'stock' => 'required|array',
             'stock.*' => 'required|sometimes',
             'size' => 'required|array',
             'size.*' => 'required|sometimes',
         ]);

         foreach ($request->input('id') as $key => $value) {
             $productAttribute = ProductAttributes::find($value);
             $productAttribute->product_id = $request->product_id;
             $productAttribute->sku =$request->sku[$key];
             $productAttribute->size = $request->size[$key];
             $productAttribute->price = $request->price[$key];
             $productAttribute->stock = $request->stock[$key];
             $productAttribute->status = $request->status[$key];
             $productAttribute->save();
         }

         return response()->json( [ 'message' =>  'Product Attribute Updated successfully'] );
     }

}
