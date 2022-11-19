<?php

namespace Database\Factories\Shop;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $images = [
            'k1.jpg', 'k2.jpg', 'k3.jpg', 'k4.jpg'
        ];
        $picture = Arr::random($images);
        $file_name =  Str::uuid() . '.jpg';
        $copy_path = public_path('uploads') . '/' . $file_name;
        File::copy(resource_path('fake/images') . '/' . $picture, $copy_path);
        return [
            'data_id' => '2',
            'path' => 'uploads/' . $file_name,
            'data_type' => 'jpeg',
            'description' => $this->faker->text(100),
        ];
    }
}
