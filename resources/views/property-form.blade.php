<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Description Generator</title>
    @if (file_exists(public_path('mix-manifest.json')))
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Generate Property Description</h1>
        
        <livewire:property-form />

        <footer class="mt-8 text-center">
            <p class="text-gray-600">© {{ date('Y') }} Nigeria Property Centre</p>
        </footer>
    </div>

    @if (file_exists(public_path('mix-manifest.json')))
        <script src="{{ mix('js/app.js') }}"></script>
    @else
        <script src="{{ asset('js/app.js') }}"></script>
    @endif
    @livewireScripts
</body>
</html>