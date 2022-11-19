<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategroyFactory extends Factory
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
}
