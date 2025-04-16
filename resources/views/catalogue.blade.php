@php
    use Illuminate\Support\Str;
@endphp

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bibliothèque en ligne</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-white">
<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">📚 Sunu Bibliothèque</h1>
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

<!-- Contenu Principal -->
<div class="mt-5">
    <h2 class="text-3xl font-bold text-center mb-6">📖 À la une : Nos auteurs & leurs livres</h2>
    <p class="text-center text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-8">
        Découvrez une sélection d'auteurs exceptionnels et leurs livres fascinants. Cliquez sur un livre pour en savoir plus ou explorez notre catalogue pour encore plus de découvertes.
    </p>

    <!-- Carrousel -->
    <div id="auteurCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($livres->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="flex justify-center gap-6 flex-wrap">
                        @foreach($chunk as $livre)
                            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg w-80">
                                <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="rounded-t-lg h-64 w-full object-cover">
                                <div class="p-4">
                                    <h5 class="text-lg font-bold">{{ $livre->titre }}</h5>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">✍️ <strong>{{ $livre->auteur }}</strong></p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">{{ Str::limit($livre->description, 100) }}</p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <a href="{{ route('livres.show', $livre) }}" class="text-blue-500 hover:underline text-sm">👁 Voir</a>
                                        @auth
                                            @if(Auth::user()->role == 'gestionnaire')
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('livres.edit', $livre) }}" class="text-yellow-500 hover:underline text-sm">✏️ Modifier</a>
                                                    <form action="{{ route('livres.destroy', $livre) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:underline text-sm">🗑 Supprimer</button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Contrôles du carrousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#auteurCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#auteurCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
        </button>
    </div>
</div>

<footer class="bg-white dark:bg-gray-800 text-center py-4 mt-10 shadow-lg">
    <p class="text-sm text-gray-600 dark:text-gray-400">
        © 2025 Ma Bibliothèque. Tous droits réservés.
    </p>
</footer>
</body>
</html>
