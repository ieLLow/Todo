<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen text-gray-800 antialiased">

    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center gap-8">
            <a href="{{ route('home') }}" class="font-semibold text-gray-900">Mon app</a>
            <div class="flex items-center gap-1 text-sm">
                <a href="{{ route('todos.index') }}"
                   class="px-3 py-1.5 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                    Todos
                </a>
                
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>
