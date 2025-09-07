<?php

namespace App\Enums;

enum ImageRole: string
{
    case Full = 'full';
    case Front = 'front';
    case Back = 'back';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
