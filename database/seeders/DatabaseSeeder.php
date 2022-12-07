<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop\Product;
use App\Models\Category;
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
        // 商品類別
        // $productCategoryId = config('product.category.id');
        // $productSubCategory = config('product.sub_category');
        // Category::factory()->create([
        //     'id' => $productCategoryId,
        //     'name' => config('product.category.name'),
        // ]);
        // foreach($productSubCategory as $item){
        //     Category::factory()->create([
        //         'parent_id' => $productCategoryId,
        //         'id' => $item['id'],
        //         'name' => $item['name'],
        //     ]);
        // }
        
        // // 全站類別
        // Category::factory(5)->create();

        // // 規格
        // SpecCategory::factory(10)->create();

        // Product::factory(10)->create();
    }
}
