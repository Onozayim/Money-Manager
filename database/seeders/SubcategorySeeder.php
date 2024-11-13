<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SubCategory::factory(10)->create();
        SubCategory::create([
            'name' => 'Luz',
            'category_id' => 1
        ]);

        SubCategory::create([
            'name' => 'Agua',
            'category_id' => 1
        ]);

        SubCategory::create([
            'name' => 'Seguro',
            'category_id' => 1
        ]);

        SubCategory::create([
            'name' => 'Telefoía',
            'category_id' => 1
        ]);


        SubCategory::create([
            'name' => 'Internet',
            'category_id' => 1
        ]);

        SubCategory::create([
            'name' => 'Otro',
            'category_id' => 1
        ]);

        SubCategory::create([
            'name' => 'VideoJuego',
            'category_id' => 2
        ]);

        SubCategory::create([
            'name' => 'Coleccionable',
            'category_id' => 2
        ]);

        SubCategory::create([
            'name' => 'Libro',
            'category_id' => 2
        ]);

        SubCategory::create([
            'name' => 'Salida',
            'category_id' => 2
        ]);

        SubCategory::create([
            'name' => 'Otro',
            'category_id' => 2
        ]);

        SubCategory::create([
            'name' => 'Ahorros',
            'category_id' => 3
        ]);

        SubCategory::create([
            'name' => 'Otros',
            'category_id' => 3
        ]);

        SubCategory::create([
            'name' => 'Inversiones',
            'category_id' => 4
        ]);

        SubCategory::create([
            'name' => 'Otros',
            'category_id' => 4
        ]);

    }
}
