<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id')->select(['id','category_name']);
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id')->select(['id','name']);
    }

    public function subcategories(){
        return $this->hasMany(Category::class,'parent_id')->where('status',1)->select(['id','parent_id','category_name','url','category_image']);
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id')->where('status',1);
    }

    public static function getCategoryName($category_id){
        $category = Category::select('category_name')->where('id',$category_id)->first();
        return $category->category_name;
    }

    public static function getCategory($url){
        $category = Category::whereUrl($url)->first();

        $categoryId = [];
        $categoryId[] = $category->id;
        foreach ($category->subcategories as $subcategory) {
            $categoryId[] = $subcategory->id;
        }

        return $categoryId;
    }


}
