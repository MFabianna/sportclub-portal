<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-950 to-violet-950 relative overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-[128px] opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-600 rounded-full mix-blend-screen filter blur-[128px] opacity-20 animate-pulse" style="animation-delay: 1s;"></div>

        <div class="max-w-md w-full space-y-8 bg-slate-800/40 backdrop-blur-xl p-10 rounded-2xl shadow-2xl border border-white/10 relative z-10">
            
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-white tracking-tight">
                    Sport<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-violet-400">Club</span>
                </h2>
                <p class="mt-2 text-sm text-slate-300">Créez votre espace personnel</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-200 mb-1">Nom complet</label>
                    <input id="name" name="name" type="text" required autofocus 
                        class="appearance-none block w-full px-4 py-3 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition sm:text-sm bg-slate-900/50" 
                        placeholder="Jean Dupont" value="{{ old('name') }}">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-200 mb-1">Adresse Email</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none block w-full px-4 py-3 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition sm:text-sm bg-slate-900/50" 
                        placeholder="votre@email.com" value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-200 mb-1">Mot de passe</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none block w-full px-4 py-3 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition sm:text-sm bg-slate-900/50" 
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-200 mb-1">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                        class="appearance-none block w-full px-4 py-3 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition sm:text-sm bg-slate-900/50" 
                        placeholder="••••••••">
                </div>

                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-gradient-to-r from-blue-600 to-violet-600 hover:from-blue-500 hover:to-violet-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-blue-500 transition duration-200 shadow-lg transform hover:-translate-y-0.5 mt-6">
                    S'inscrire
                </button>

                <div class="text-center mt-4">
                    <p class="text-sm text-slate-300">
                        Déjà un compte ? 
                        <a href="{{ route('login') }}" class="font-bold text-blue-400 hover:text-violet-400 transition">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>