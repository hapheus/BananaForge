<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div
    class="hero min-h-screen"
    style="background-image: url({{ asset('img/BananaForge.jpg') }});"
>
    <div class="hero-overlay"></div>
    <div class="hero-content text-neutral-content text-center">
        <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">Banana Forge</h1>
            <p class="mb-5">
                BananaForge is a playful yet powerful pipeline that transforms text prompts into 3D-printable models.
                Using Gemini Flash, it generates consistent front and back views of cute figurines—like peeling a banana
                to reveal both sides. These paired images are then converted into STL files through a dedicated 3D
                service, enabling seamless creation of physical models ready for printing.
            </p>
            <button class="btn btn-primary">Get Started</button>
        </div>
    </div>
</div>

</body>
</html>
