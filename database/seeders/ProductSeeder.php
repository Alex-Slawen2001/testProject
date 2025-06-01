<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\PropertyValue;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $product1 = Product::create([
            'name' => 'Настольный светильник',
            'price' => 2490,
            'quantity' => 7,
        ]);

        $product2 = Product::create([
            'name' => 'Умная лампа',
            'price' => 1790,
            'quantity' => 15,
        ]);

        $red = PropertyValue::where('value', 'Красный')->first();
        $blue = PropertyValue::where('value', 'Синий')->first();
        $philips = PropertyValue::where('value', 'Philips')->first();
        $xiaomi = PropertyValue::where('value', 'Xiaomi')->first();

        // Привязываем значения к товарам (pivot)
        $product1->propertyValues()->attach([$red->id, $philips->id]); // светильник: красный, Philips, на что фантазии хватило)
        $product2->propertyValues()->attach([$blue->id, $xiaomi->id]); // лампа: синий, Xiaomi
    }
}
