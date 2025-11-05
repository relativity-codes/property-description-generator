<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Description Generator</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <header class="mb-6">
            <h1 class="text-3xl font-bold">Property Description Generator</h1>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
</body>
</html>