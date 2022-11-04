<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'json'
    ];

    protected $guarded = [];


    public function getAttribute($key)
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->value)) {
            return $this->value[$key];
        }

        return $attribute;
    }

}
