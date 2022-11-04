<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public static function sections()
    {
        $sections = Section::with('categories')->where('status', 1)->get();
        return $sections;
    }

    public function categories()
    {
        return $this->hasMany(Category::class,'section_id')
            ->where(['parent_id'=>null,'status'=>1])
            ->with('subcategories');
    }

}
