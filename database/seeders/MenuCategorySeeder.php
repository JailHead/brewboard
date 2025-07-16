<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bebidas Calientes',
                'description' => 'Cafés, tés y otras bebidas calientes'
            ],
            [
                'name' => 'Bebidas Frías',
                'description' => 'Frapés, refrescos y bebidas heladas'
            ],
            [
                'name' => 'Postres',
                'description' => 'Pasteles, galletas y dulces'
            ],
            [
                'name' => 'Snacks',
                'description' => 'Bocadillos y comida ligera'
            ]
        ];

        foreach ($categories as $category) {
            MenuCategory::create($category);
        }
    }
}