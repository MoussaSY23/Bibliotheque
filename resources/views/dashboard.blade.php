<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h1 class="mt-2">
            Bienvenue Mr {{ Auth::user()->prenom }}
        </h1>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900">Nos Livres Populaires</h3>
            <p>Affichage basique pour tester</p>
        </div>
    </div>

</x-app-layout>
