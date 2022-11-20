<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
            'name' => $this->faker->text(20),
            'order' => '0',
            'display' => '1'
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Category $category) {
        })->afterCreating(function (Category $category) {
            Category::create([
                'parent_id' => $category->id,
                'name' => $this->faker->text(20),
                'order' => '0',
                'display' => '1'
            ]);
        });
    }
}
