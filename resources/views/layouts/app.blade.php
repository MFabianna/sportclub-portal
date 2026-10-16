<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-authenticated" content="{{ auth()->check() ? 'true' : 'false' }}">
    <title>{{ config('app.name', 'SportClub') }}</title>
    
    <!-- Polices & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- SweetAlert2 & GSAP -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1e293b; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #475569; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #64748b; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-900 text-white overflow-hidden">

    <div class="flex h-screen w-full">
        
        <!-- SIDEBAR FIXE -->
        <aside id="sidebar" class="w-64 bg-slate-800/40 backdrop-blur-xl border-r border-white/10 flex flex-col fixed inset-y-0 left-0 z-40 transition-transform duration-300 transform md:translate-x-0">
            
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-white/10 px-6">
                <a href="{{ route('welcome') }}" class="text-2xl font-bold tracking-tight text-white hover:text-indigo-400 transition-colors">
                    Sport<span class="text-indigo-400">Club</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar py-4 px-3 space-y-2">
                
                @if(auth()->user()->role === 'admin')
                    <!-- DASHBOARD (Admin uniquement) -->
                    <a href="{{ route('dashboard') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-200 hover:bg-slate-700/50 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="font-medium">Tableau de Bord</span>
                    </a>

                    <div class="pt-4 pb-1 px-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Administration</p>
                    </div>

                    <!-- Joueurs -->
                    <a href="{{ route('joueurs.index') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('joueurs.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-200 hover:bg-slate-700/50 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="font-medium">Joueurs</span>
                    </a>

                    <!-- Cotisations -->
                    <a href="{{ route('cotisations.index') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('cotisations.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-200 hover:bg-slate-700/50 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Cotisations</span>
                    </a>

                    <!-- Événements (REMIS À SA PLACE) -->
                    <a href="{{ route('evenements.index') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('evenements.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-200 hover:bg-slate-700/50 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">Événements</span>
                    </a>

                @else
                    <!-- ESPACE PARENT / JOUEUR -->
                    <div class="pt-2 pb-1 px-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mon Espace</p>
                    </div>

                    <a href="{{ route('dashboard') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-200 hover:bg-slate-700/50 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-medium">Accueil</span>
                    </a>

                    <a href="#" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 text-slate-200 hover:bg-slate-700/50 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Mon Profil</span>
                    </a>

                    <a href="#" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 text-slate-200 hover:bg-slate-700/50 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="font-medium">Mes Convocations</span>
                    </a>
                @endif
            </nav>

            <!-- Déconnexion -->
            <div class="p-4 border-t border-white/10 bg-slate-800/20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition text-sm font-medium group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTENU PRINCIPAL -->
        <main class="flex-1 ml-64 p-8 overflow-y-auto h-screen bg-slate-900 relative">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-slate-900 via-slate-900 to-slate-800 -z-10 pointer-events-none"></div>
            {{ $slot }}
        </main>
        
    </div>

    <script>
        // Animations Sidebar
        gsap.from("#sidebar", { x: -100, opacity: 0, duration: 0.8, ease: "power3.out" });
        gsap.from(".nav-item", { x: -20, opacity: 0, duration: 0.5, stagger: 0.1, delay: 0.3, ease: "power2.out" });

        // SweetAlert Flash Messages
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Succès !', text: "{{ session('success') }}", timer: 2500, showConfirmButton: false, toast: true, position: 'top-end', background: '#1e293b', color: '#fff' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Erreur...', text: "{{ session('error') }}", timer: 3000, showConfirmButton: false, toast: true, position: 'top-end', background: '#1e293b', color: '#fff' });
        @endif
    </script>
</body>
</html>