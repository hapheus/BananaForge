<?php

namespace App\Observers;

use App\Enums\GenerationStatus;
use App\Jobs\GenerateImageJob;
use App\Models\Generation;

class GenerationObserver
{
    public function creating(Generation $generation): void
    {
        $generation->status = GenerationStatus::Queued;
    }

    public function created(Generation $generation): void
    {
        GenerateImageJob::dispatch($generation);
    }
}
