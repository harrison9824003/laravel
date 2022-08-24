<?php

namespace Database\Factories\Shop\Entity;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Shop\Entity\Merchandise;

class MerchandiseFactory extends Factory
{
    protected $model = Merchandise::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { 
        return [
            //
            'status' => $this->faker->randomElement(['D', 'L', 'S']),
            'name' => $this->faker->numerify('product-####'),
            'name_en' => $this->faker->numerify('product-####'),
            'introduction' => $this->faker->text(100),
            'introduction_en' => $this->faker->text(100),
            'photo' => '',
            'price' => $this->faker->randomNumber(3, true),
            'remain_count' => $this->faker->randomNumber(2, true)
        ];
    }
}
