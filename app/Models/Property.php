<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
namespace App\Models;
class Property extends Model
{
    protected $fillable = ['name'];
    public function values()
    {
        return $this->hasMany(PropertyValue::class);
    }
}
