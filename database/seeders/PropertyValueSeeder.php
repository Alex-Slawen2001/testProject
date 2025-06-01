<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyValue;

class PropertyValueSeeder extends Seeder
{
    public function run()
    {
        $color = Property::where('name', 'Цвет')->first();
        $brand = Property::where('name', 'Бренд')->first();

        PropertyValue::insert([
            ['property_id' => $color->id, 'value' => 'Красный', 'created_at' => now(), 'updated_at' => now()],
            ['property_id' => $color->id, 'value' => 'Синий', 'created_at' => now(), 'updated_at' => now()],
            ['property_id' => $brand->id, 'value' => 'Philips', 'created_at' => now(), 'updated_at' => now()],
            ['property_id' => $brand->id, 'value' => 'Xiaomi', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
