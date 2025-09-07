<?php

namespace Database\Seeders;

use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Prompt;
use Illuminate\Database\Seeder;

class GenerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Generation::firstOrCreate(
            ['title' => 'Ghost'],
            [
                'prompt_id' => Prompt::first()->id,
                'input_values' => [
                    ['placeholder' => 'creature', 'value' => 'friendly ghost'],
                    ['placeholder' => 'accessory', 'value' => 'standing on a solid haunted book base'],
                    ['placeholder' => 'mood', 'value' => 'cheerful spooky'],
                ],
                'status' => GenerationStatus::Queued->value,
            ]
        );
    }
}
