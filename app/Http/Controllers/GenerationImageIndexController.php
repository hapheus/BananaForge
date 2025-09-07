<?php

namespace App\Http\Controllers;

use App\Models\Image;

class GenerationImageIndexController extends Controller
{
    public function __invoke(int $generationId)
    {
        return Image::where('generation_id', $generationId)->get();
    }
}
