<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'quantity'];
    public function propertyValues()
    {
        return $this->belongsToMany(PropertyValue::class, 'product_property_value');
    }
}
