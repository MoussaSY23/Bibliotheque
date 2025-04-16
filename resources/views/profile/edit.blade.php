<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Affichage des informations de l'utilisateur -->
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">Informations personnelles</h3>
                <p class="text-gray-700 mt-2"><strong>Nom :</strong> {{ Auth::user()->nom }}</p>
                <p class="text-gray-700"><strong>Prénom :</strong> {{ Auth::user()->prenom }}</p>
                <p class="text-gray-700"><strong>Email :</strong> {{ Auth::user()->email }}</p>
                <p class="text-gray-700"><strong>Téléphone :</strong> {{ Auth::user()->telephone ?? 'Non renseigné' }}</p>
                <p class="text-gray-700"><strong>Adresse :</strong> {{ Auth::user()->adresse ?? 'Non renseigné' }}</p>
            </div>

            <!-- Formulaire de modification des informations -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Formulaire de modification du mot de passe -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Formulaire de suppression du compte -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
