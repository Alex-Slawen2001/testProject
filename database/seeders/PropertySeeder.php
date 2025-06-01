<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Property::insert([
            ['name' => 'Цвет', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Бренд', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
