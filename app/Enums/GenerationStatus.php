<?php

namespace App\Enums;

enum GenerationStatus: string
{
    case Queued = 'queued';
    case Running = 'running';
    case Done = 'done';
    case Failed = 'failed';

    /**
     * Get all enum values as an array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Check if the generation is in a completed state
     */
    public function isCompleted(): bool
    {
        return in_array($this, [self::Done, self::Failed]);
    }

    /**
     * Check if the generation is successful
     */
    public function isSuccessful(): bool
    {
        return $this === self::Done;
    }
}
