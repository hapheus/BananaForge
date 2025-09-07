<?php

namespace App\Observers;

use App\Enums\GenerationStatus;
use App\Models\Generation;

class GenerationObserver
{
    public function creating(Generation $generation): void
    {
        $generation->status = GenerationStatus::Queued;
    }
}
