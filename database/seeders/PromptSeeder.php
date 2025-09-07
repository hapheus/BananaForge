<?php

namespace Database\Seeders;

use App\Models\Prompt;
use Illuminate\Database\Seeder;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prompt::firstOrCreate(
            ['title' => 'Halloween'],
            [
                'prompt' => <<<PROMPT
A wide product shot, split into two equal halves.

Left Half:
A high-quality, professional front view of a single 3D-printed figure, seen from eye level. The entire figure must be fully visible and centered.

Right Half:
The exact same figure, rotated 180 degrees, showing a precise back view. The figure's position and size must be perfectly aligned with the front view to create a seamless rotation effect.

Figure Details:
The character is a **{mood} {creature}**, equipped with **{accessory}**. It is designed in a cute Halloween style, with a simplified, cartoon-like, and toy-like (chibi-style) aesthetic. Proportions are chunky and sturdy, with thick limbs and a robust torso.

3D Printing Details:
The figure has a flat, stable bottom surface and stands directly on the background, without a base. **It is explicitly designed for support-free 3D printing, featuring no overhangs or angles that would require support structures.** All parts—including limbs and accessories—are thick, robust, and positioned close to the main body to ensure maximum stability and ease of printing without supports. The design avoids thin walls, fragile elements, or complex geometries that would necessitate support material.

Material and Background:
The figure is printed from a **matte, light gray PLA filament**, with sharp, deep layer lines and contours like a real 3D print. The background is a clean, uniform, and neutral light gray, with no textures or patterns.

Important: The front and back views must be perfectly consistent, as if they are the same physical object seen from two different sides.
PROMPT,
                'placeholders' => [
                    ['placeholder' => 'mood'],
                    ['placeholder' => 'creature'],
                    ['placeholder' => 'accessory'],
                    ],
            ]
        );
    }
}
