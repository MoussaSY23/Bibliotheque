<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center px-4 py-8" style="background-image: url('{{ asset('storage/images/1740016812712.jpg') }}');">
        <div class="w-full max-w-2xl bg-white bg-opacity-20 backdrop-blur-lg shadow-2xl rounded-2xl border border-white/30 p-10 text-gray-800">

            <!-- Titre et intro -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white drop-shadow">Bienvenue à <span class="text-yellow-300">Sama Librairie</span></h1>
                <p class="text-sm text-white/90 mt-2 italic">Découvrez, explorez, lisez 📚</p>
                <p class="text-sm text-white/80">Connectez-vous pour accéder à votre univers littéraire personnalisé</p>
            </div>

            <!-- Message session -->
            <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

            <!-- Formulaire -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="relative">
                    <label for="email" class="block mb-1 text-white text-sm font-medium">Adresse e-mail</label>
                    <x-text-input id="email" type="email" name="email"
                                  class="block w-full rounded-md p-3 pl-10 bg-white/80 text-gray-800 shadow-sm focus:ring-2 focus:ring-yellow-400"
                                  placeholder="exemple@samalibrairie.com"
                                  :value="old('email')" required autofocus autocomplete="username" />
                    <div class="absolute left-3 top-10 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500" />
                </div>

                <!-- Mot de passe -->
                <div class="relative">
                    <label for="password" class="block mb-1 text-white text-sm font-medium">Mot de passe</label>
                    <x-text-input id="password" type="password" name="password"
                                  class="block w-full rounded-md p-3 pl-10 bg-white/80 text-gray-800 shadow-sm focus:ring-2 focus:ring-yellow-400"
                                  placeholder="Votre mot de passe"
                                  required autocomplete="current-password" />
                    <div class="absolute left-3 top-10 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500" />
                </div>

                <!-- Options -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-white">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-yellow-400 focus:ring-yellow-400">
                        Se souvenir de moi
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-yellow-200 hover:underline" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Bouton -->
                <div>
                    <x-primary-button class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 rounded-md transition-all">
                        Se connecter
                    </x-primary-button>
                </div>
            </form>

            <!-- Lien inscription -->
            <div class="text-center mt-6 text-sm text-white">
                Vous n'avez pas encore de compte ?
                <a href="{{ route('register') }}" class="text-yellow-200 underline hover:text-yellow-300">Créer un compte</a>
            </div>

        </div>
    </div>
</x-guest-layout>
