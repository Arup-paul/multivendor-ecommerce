<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand','vendor')->paginate(20);

        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::select(['id','category_name'])->get();
        $brands = Brand::select(['id','name'])->get();
        return view('admin.products.create',compact('categories','brands'));
    }

    public function store(ProductRequest $request){
        $product = new Product();
        $productService = new ProductService();
        $productService->productCreateUpdate($request,$product);
        $product->save();
        return response()->json( [ 'message' =>  'Product created successfully'] );
    }


    public function  edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::select(['id','category_name'])->get();
        $brands = Brand::select(['id','name'])->get();
        return view('admin.products.edit',compact('categories','brands','product'));
    }

    public function update(ProductRequest $request,$id){
        $product = Product::findOrFail($id);
        $productService = new ProductService();
        $productService->productCreateUpdate($request,$product);
        $product->save();

        return response()->json( [ 'message' =>  'Product Updated successfully'] );


    }

    public function massDestroy(Request $request)
    {
        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $product = Product::findOrFail($id);
                    if(file_exists($product->product_image)){
                        unlink($product->product_image);
                    }
                    $product->delete();
                }
                return response()->json([
                    'message' =>  __('Products Deleted Successfully'),
                    'redirect' => route('admin.categories.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




    }

}