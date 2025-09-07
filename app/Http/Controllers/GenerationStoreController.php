<?php

namespace App\Http\Controllers;

use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Prompt;

class GenerationStoreController extends Controller
{
    public function __invoke()
    {
        return Generation::create(
            [
                'title' => 'Ghost',
                'prompt_id' => Prompt::first()->id,
                'input_values' => [
                    ['placeholder' => 'creature', 'value' => 'friendly ghost'],
                    ['placeholder' => 'accessory', 'value' => 'standing on a solid haunted book base'],
                    ['placeholder' => 'mood', 'value' => 'cheerful spooky'],
                ],
                'status' => GenerationStatus::Queued->value,
            ]
        )->toArray();
    }
}
