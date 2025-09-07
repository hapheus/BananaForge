<?php

namespace App\Jobs;

use App\Enums\GenerationStatus;
use App\Enums\ImageRole;
use App\Models\Generation;
use App\Models\Image;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class GenerateImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Generation $generation) {}

    public function handle(): void
    {
        $this->generation->refresh();
        $this->generation->status = GenerationStatus::Running;
        $this->generation->save();

        try {
            $prompt = $this->generation->prompt;
            $generationPrompt = $prompt->prompt;
            $values = collect($this->generation->input_values)
                ->pluck('value', 'placeholder')
                ->toArray();

            foreach ($values as $key => $value) {
                $generationPrompt = Str::replace("{{$key}}", $value, $generationPrompt);
            }

            $response = Cache::rememberForever(md5($generationPrompt), fn () => Http::withHeaders([
                'x-goog-api-key' => config('app.GOOGLE_API_KEY'),
                'Content-Type' => 'application/json',
            ])
                ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-image-preview:generateContent', [
                    'contents' => [[
                        'parts' => [
                            [
                                'text' => $generationPrompt,
                            ],
                        ],
                    ]],
                ])->json());

            $data = $response['candidates'][0]['content']['parts'];

            $imagePart = Arr::first($data, function ($part) {
                return isset($part['inlineData']['mimeType']) &&
                    str_starts_with($part['inlineData']['mimeType'], 'image/');
            });

            $imageData = $imagePart['inlineData']['data'] ?? null;

            $uuid = Str::uuid()->toString();
            $imageNameFull = $uuid.'__'.ImageRole::Full->value.'.png';
            $imageNameFront = $uuid.'__'.ImageRole::Front->value.'.png';
            $imageNameBack = $uuid.'__'.ImageRole::Back->value.'.png';
            Storage::disk('public')->put($imageNameFull, base64_decode($imageData));
            Image::create([
                'generation_id' => $this->generation->id,
                'role' => ImageRole::Full->value,
                'path' => $imageNameFull,
            ]);

            $front = ImageManager::gd()->read(Storage::disk('public')->path($imageNameFull));
            $front->crop(512, 1024, 0, 0);
            $front->save(Storage::disk('public')->path($imageNameFront));
            Image::create([
                'generation_id' => $this->generation->id,
                'role' => ImageRole::Front->value,
                'path' => $imageNameFront,
            ]);
            $back = ImageManager::gd()->read(Storage::disk('public')->path($imageNameFull));
            $back->crop(512, 1024, 512, 0);
            $back->save(Storage::disk('public')->path($imageNameBack));
            Image::create([
                'generation_id' => $this->generation->id,
                'role' => ImageRole::Back->value,
                'path' => $imageNameBack,
            ]);

            $this->generation->refresh();
            $this->generation->status = GenerationStatus::Done;
            $this->generation->save();
        } catch (Exception) {
            $this->generation->refresh();
            $this->generation->status = GenerationStatus::Failed;
            $this->generation->save();
        }
    }
}
