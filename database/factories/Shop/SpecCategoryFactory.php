<?php

namespace Database\Factories\Shop;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop\SpecCategory;

class SpecCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => '0',
            'name' => $this->faker->text(10),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (SpecCategory $specCategory) {
        })->afterCreating(function (SpecCategory $specCategory) {
            // 建立子類別
            for($i=0 ; $i<5 ; $i++){
                SpecCategory::create([
                    'name' => $this->faker->text(10),
                    'parent_id' => $specCategory->id
                ]);
            }
            
        });
    }
}
