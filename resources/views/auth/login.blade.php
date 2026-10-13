<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-950 to-violet-950 relative overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-[128px] opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-600 rounded-full mix-blend-screen filter blur-[128px] opacity-20 animate-pulse" style="animation-delay: 1s;"></div>

        <div class="max-w-md w-full space-y-8 bg-slate-800/40 backdrop-blur-xl p-10 rounded-2xl shadow-2xl border border-white/10 relative z-10">
            
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-white tracking-tight">
                    Sport<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-violet-400">Club</span>
                </h2>
                <p class="mt-2 text-sm text-slate-300">Portail de Gestion de Club Sportif</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-200 mb-1">Adresse Email</label>
                    <input id="email" name="email" type="email" required autofocus 
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

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-600 text-blue-500 shadow-sm focus:ring-blue-500 bg-slate-900/50" name="remember">
                        <span class="ml-2 text-sm text-slate-300">Se souvenir de moi</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-blue-400 hover:text-violet-400 transition" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-gradient-to-r from-blue-600 to-violet-600 hover:from-blue-500 hover:to-violet-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-blue-500 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                    Se connecter
                </button>

                <div class="text-center mt-4">
                    <p class="text-sm text-slate-300">
                        Pas encore de compte ? 
                        <a href="{{ route('register') }}" class="font-bold text-blue-400 hover:text-violet-400 transition">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </form>
          <!-- Protection -->
            @if(app()->environment('local'))
                <div class="mt-6 text-center pt-6 border-t border-white/10">
                    <form method="POST" action="{{ route('dev.login') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-500 hover:text-red-400 hover:underline font-bold">
                            🔧 DEV : Connexion Auto Admin (Sans mot de passe)
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>