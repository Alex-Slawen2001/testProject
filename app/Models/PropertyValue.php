<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
    protected $fillable = ['property_id', 'value'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_property_value');
    }
}
