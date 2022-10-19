<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class)->select(['id','category_name']);
    }

    public function section()
    {
        return $this->belongsTo(Section::class)->select(['id','name']);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class)->select(['id','name']);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class)->select(['id','name']);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class,'product_id');
    }
}
