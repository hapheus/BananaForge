<?php

namespace App\Http\Controllers;

use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GenerationStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $validated = $request->validate([
                'creature' => 'required|string|max:100',
                'accessory' => 'required|string|max:100',
                'mood' => 'required|string|max:100',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $prompt = Prompt::first(); // Still assuming a generic prompt template

        return Generation::create(
            [
                'title' => 'Custom Figure: '.$validated['creature'],
                'prompt_id' => $prompt->id,
                'input_values' => [
                    ['placeholder' => 'creature', 'value' => $validated['creature']],
                    ['placeholder' => 'accessory', 'value' => $validated['accessory']],
                    ['placeholder' => 'mood', 'value' => $validated['mood']],
                ],
                'status' => GenerationStatus::Queued->value,
            ]
        );
    }
}
