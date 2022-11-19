<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop\Product;
use App\Models\Categroy;
use App\Models\Shop\SpecCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // 全站類別
        Categroy::factory(10)->create();

        // 規格
        SpecCategory::factory(10)->create();

        Product::factory(10)->create();
    }
}
