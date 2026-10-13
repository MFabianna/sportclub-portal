<x-guest-layout>
    <!-- Fond sombre avec halos lumineux (Identique aux autres pages) -->
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-950 to-violet-950 relative overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
        
        <!-- Halo Bleu en haut à gauche -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-[128px] opacity-20 animate-pulse"></div>
        <!-- Halo Violet en bas à droite -->
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-600 rounded-full mix-blend-screen filter blur-[128px] opacity-20 animate-pulse" style="animation-delay: 1s;"></div>

        <!-- La carte du formulaire (Effet Verre Sombre) -->
        <div class="max-w-md w-full space-y-8 bg-slate-800/40 backdrop-blur-xl p-10 rounded-2xl shadow-2xl border border-white/10 relative z-10">
            
            <!-- En-tête -->
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-white tracking-tight">
                    Sport<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-violet-400">Club</span>
                </h2>
                <p class="mt-2 text-sm text-slate-300">Récupération de mot de passe</p>
            </div>

            <!-- Message d'information -->
            <div class="text-center">
                <p class="text-sm text-slate-300">
                    Mot de passe oublié ? Pas de problème. Indiquez-nous votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
                </p>
            </div>

            <!-- Message de succès (si l'email a été envoyé) -->
            @if (session('status'))
                <div class="mb-4 p-4 rounded-lg bg-green-500/20 border border-green-500/30 text-green-300 text-sm text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-200 mb-1">Adresse Email</label>
                    <input id="email" name="email" type="email" required autofocus 
                        class="appearance-none block w-full px-4 py-3 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition sm:text-sm bg-slate-900/50" 
                        placeholder="votre@email.com" value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Bouton -->
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-gradient-to-r from-blue-600 to-violet-600 hover:from-blue-500 hover:to-violet-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-blue-500 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                    Envoyer le lien de réinitialisation
                </button>

                <!-- Lien Retour à la connexion -->
                <div class="text-center mt-4">
                    <p class="text-sm text-slate-300">
                        <a href="{{ route('login') }}" class="font-bold text-blue-400 hover:text-violet-400 transition">
                            ← Retour à la connexion
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>