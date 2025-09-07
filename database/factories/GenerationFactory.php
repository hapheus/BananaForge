<?php

namespace Database\Factories;

use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Prompt;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GenerationFactory extends Factory
{
    protected $model = Generation::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'input_values' => $this->faker->words(),
            'status' => $this->faker->randomElement(GenerationStatus::cases()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'prompt_id' => Prompt::factory(),
        ];
    }
}
