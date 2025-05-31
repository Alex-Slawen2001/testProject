<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPropertyValue extends Model
{
    protected $table = 'product_property_value';
    protected $fillable = ['product_id', 'property_value_id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function propertyValue()
    {
        return $this->belongsTo(PropertyValue::class);
    }
}
