<?php

namespace App\Models;

use App\Enums\GenerationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Generation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class);
    }

    protected function casts(): array
    {
        return [
            'input_values' => 'array',
            'status' => GenerationStatus::class,
        ];
    }
}
