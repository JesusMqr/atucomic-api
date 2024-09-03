<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order'=>fake()->randomNumber(2),
            'image'=>fake()->imageUrl(600,900),
            'chapter_id'=>Chapter::all()->random()->id,
            'user_id'=>User::all()->random()->id,
        ];
    }
}
