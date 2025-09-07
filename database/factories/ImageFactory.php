<?php

namespace Database\Factories;

use App\Models\Generation;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'role' => $this->faker->word(),
            'path' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'generation_id' => Generation::factory(),
        ];
    }
}
