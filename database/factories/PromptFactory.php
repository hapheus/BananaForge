<?php

namespace Database\Factories;

use App\Models\Prompt;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PromptFactory extends Factory
{
    protected $model = Prompt::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'prompt' => $this->faker->word(),
            'placeholders' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
