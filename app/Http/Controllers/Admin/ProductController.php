<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function index()
    {
        $admin = auth()->guard('admin')->user();
        if($admin->type == 'superadmin'){
            $products = Product::with('category','brand','vendor')->orderByDesc('id')->paginate(20);
        }else{
             $vendor = Vendor::find($admin->vendor_id);
             if($vendor->status == 0){
                 return redirect()->route('admin.update-vendor-details','personal')->with('error','Please update your profile details');
             }else if($vendor->is_business_details == 0) {
                 return redirect()->route('admin.update-vendor-details', 'business')->with('error', 'Please update your business details');
             }

            $products = Product::with('category','brand','vendor')->where('vendor_id',$admin->vendor_id)->orderByDesc('id')->paginate(20);
        }



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

    public function categoryFilter(Request $request){
       if($request->ajax()){
            $category_id = $request->input('category_id');
            return response()->json(['view' => (String)View::make('admin.products.filters',compact('category_id'))]);



       }
    }

}
