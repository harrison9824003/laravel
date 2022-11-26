<?php

namespace Database\Factories\Shop;

use App\Models\Category;
use App\Models\RelationShipCatory;
use App\Models\Shop\Product;
use App\Models\Shop\ProductImage;
use App\Models\Shop\ProductSpec;
use App\Models\Shop\SpecCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(10, 100),
            'market_price' => $this->faker->numberBetween(200, 300),
            'simple_intro' => $this->faker->text(100),
            'intro' => $this->faker->text(200),
            'part_number' => $this->faker->unique()->numberBetween(1000, 2000),
            'end_date' => '2030-12-31 12:00:00',
            'user_id' => '1'
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Product $product) {
        })->afterCreating(function (Product $product) {
            // 建立圖片
            $images = [
                'k1.jpg', 'k2.jpg', 'k3.jpg', 'k4.jpg'
            ];
            $picture = Arr::random($images);
            $file_name =  Str::uuid() . '.jpg';
            $copy_path = public_path('uploads/images') . '/' . $file_name;
            File::copy(resource_path('fake/images') . '/' . $picture, $copy_path);
            ProductImage::create([
                'data_id' => '2',
                'item_id' => $product->id,
                'path' => 'images/' . $file_name,
                'data_type' => 'jpeg',
                'description' => $this->faker->text(100),
            ]);

            // 建立網站類別關係對應
            $productSubCategory = config('product.sub_category');
            RelationShipCatory::create([
                'data_id' => '2',
                'category_id' => Arr::random($productSubCategory)['id'],
                'item_id' => $product->id
            ]);

            // 建立規格
            $specCategory = SpecCategory::where('parent_id', '!=', '0')->get()->random(1)->first()->id;
            ProductSpec::create([
                'category_id' => $specCategory,
                'product_id' => $product->id,
                'reserve_num' => '10',
                'low_reserve_num' => '1',
                'volume' => '5',
                'weight' => '10',
                'order' => '0',
            ]);
        });
    }
}
