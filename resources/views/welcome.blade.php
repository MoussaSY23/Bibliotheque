<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bibliothèque en ligne</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-white">
<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">📚 Ma Bibliothèque</h1>
        <nav class="space-x-4">
            <a href="{{ url('/') }}" class="hover:underline">Accueil</a>
            <a href="{{ route('catalogue') }}" class="hover:underline">Catalogue</a>

            @auth
                <a href="{{ url('/dashboard') }}" class="hover:underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hover:underline">Inscription</a>
                @endif
            @endauth
        </nav>
    </div>
</header>

<main class="mt-10 text-center">
    <h2 class="text-4xl font-bold mb-4">Bienvenue sur notre bibliothèque en ligne</h2>
    <p class="text-lg mb-6">Découvrez, explorez et achetez des livres en quelques clics !</p>
    <a href="{{ route('catalogue') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full text-lg">
        Voir le catalogue
    </a>
</main>

<footer class="mt-20 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
    &copy; {{ date('Y') }} Ma Bibliothèque. Tous droits réservés.
</footer>
</body>
</html>
