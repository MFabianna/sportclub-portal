<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-900 flex">
            
            <!-- SIDEBAR (Barre latérale gauche) -->
            <aside class="w-64 bg-slate-800/40 backdrop-blur-xl border-r border-white/10 flex flex-col fixed h-full">
                <!-- Logo -->
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-white tracking-tight">
                        Sport<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-violet-400">Club</span>
                    </h1>
                </div>

                <!-- Menu de navigation -->
                <nav class="flex-1 px-4 space-y-2 mt-4">
                    <a href="#" class="flex items-center px-4 py-3 text-white bg-gradient-to-r from-blue-600 to-violet-600 rounded-lg shadow-lg">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('joueurs') }}" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition">
                        👥 Joueurs
                    </a>
                    <a href="{{route('cotisations')}}" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition">
                        💰 Cotisations
                    </a>
                   <a href="{{ route('evenements.index') }}" class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition">
                        📅 Événements
                    </a>
                </nav>

                <!-- Bouton de déconnexion -->
                <div class="p-4 border-t border-white/10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition text-sm font-medium">
                             Se déconnecter
                        </button>
                    </form>
                </div>
            </aside>

            <!-- CONTENU PRINCIPAL (Zone de droite) -->
            <main class="flex-1 ml-64 p-8 overflow-y-auto">
                {{ $slot }}
            </main>
            
        </div>
    </body>
</html>