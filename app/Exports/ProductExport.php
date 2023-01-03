<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $admin = auth()->guard('admin')->user();
        if($admin->type == 'superadmin'){
            $products = Product::orderByDesc('id');
        }else{
            $products = Product::where('vendor_id',$admin->vendor_id)->orderByDesc('id');
        }
        $products = $products->with('category','brand','vendor','attributes')
            ->select(['id','category_id','section_id','brand_id','vendor_id','product_name','product_color','product_code','product_price','product_discount','product_weight','description'])
            ->orderByDesc('id')->whereStatus(1)->limit(20)->get();

        //product brand name map
        $products->map(function($product){
            $product->brand_name = $product->brand->name;
            $product->category_name = $product->category->category_name;
            $product->section_name = $product->section->name;
            $product->vendor_name = $product->vendor->name ?? 'Admin';
            $product->product_sku = $product->attributes->map(function($attribute){
                return $attribute->sku;
            })->implode(',');
            $product->product_size = $product->attributes->map(function($attribute){
                return $attribute->size;
            })->implode(',');
            $product->product_attribute_price = $product->attributes->map(function($attribute){
                return $attribute->price;
            })->implode(',');
            $product->product_stock = $product->attributes->map(function($attribute){
                return $attribute->stock;
            })->implode(',');
            return $product;
        });

        foreach ($products as $product){
            unset($product->category_id);
            unset($product->section_id);
            unset($product->brand_id);
            unset($product->vendor_id);
        }


        return $products;
    }

    public function headings(): array
    {
         return [
            'ID',
            'Product Name',
            'Product Color',
            'Product Code',
            'Product Price',
            'Product Discount',
            'Product Weight',
            'Description',
            'Category',
            'Section',
            'Brand',
            'Vendor',
            'Product Attribute SKU',
            'Product Attribute Size',
            'Product Attribute Price',
            'Product Attribute Stock',
        ];
    }
}
