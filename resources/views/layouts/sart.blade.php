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
