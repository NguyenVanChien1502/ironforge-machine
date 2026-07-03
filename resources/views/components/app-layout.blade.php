<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'IronForge Machinery — Premium Industrial Equipment' }}</title>
    <meta name="description" content="{{ $description ?? 'Premium heavy machinery and industrial equipment for construction, mining, and infrastructure projects.' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-charcoal antialiased">
    @include('partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')
</body>
</html>
