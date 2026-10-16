<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="user-authenticated" content="{{ auth()->check() ? 'true' : 'false' }}">
    <title>SportClub - Gestion Moderne de Club Sportif</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #0f172a; color: white; overflow-x: hidden; }
        .hero-bg {
            background-image: linear-gradient(to bottom right, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.8)), url('https://images.unsplash.com/photo-1517649763962-0c62310b0647?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.6);
        }
        /* Animation classes */
        .fade-in-up { opacity: 0; transform: translateY(20px); }
    </style>
</head>
<body class="antialiased">

    <!-- Navbar avec Logo Cliquable -->
    <nav class="fixed w-full z-50 bg-slate-900/80 backdrop-blur-md border-b border-white/10 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo qui renvoie à l'accueil -->
                <a href="{{ route('welcome') }}" class="flex-shrink-0 flex items-center gap-2 group cursor-pointer">
                    <span class="text-2xl font-bold tracking-tighter text-white group-hover:text-indigo-400 transition-colors">
                        Sport<span class="text-indigo-400 group-hover:text-white transition-colors">Club</span>
                    </span>
                </a>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#features" class="text-slate-300 hover:text-white transition text-sm font-medium">Fonctionnalités</a>
                    <a href="#events" class="text-slate-300 hover:text-white transition text-sm font-medium">Événements</a>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg shadow-lg btn-glow transition transform hover:-translate-y-0.5">
                                    S'inscrire
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section avec Message de Bienvenue -->
    <section class="relative hero-bg min-h-screen flex items-center justify-center pt-16">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent pointer-events-none"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span id="hero-badge" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/15 bg-white/5 backdrop-blur text-slate-300 text-xs font-semibold mb-6 fade-in-up">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                ✨ Version 1.0 disponible
            </span>
            <h1 id="hero-title" class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 fade-in-up">
                Bienvenue chez <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">SportClub</span>
            </h1>
            <p id="hero-subtitle" class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto fade-in-up">
                La plateforme tout-en-un pour gérer votre association sportive. Suivi des joueurs, cotisations et calendrier intelligent.
            </p>
            
            <div id="hero-buttons" class="mt-10 flex flex-col sm:flex-row justify-center gap-4 fade-in-up">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-full shadow-xl btn-glow transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    Pas encore de compte ? Inscrivez-vous
                </a>
                <a href="{{ route('login') }}" class="px-8 py-4 border border-white/30 text-white font-bold rounded-full hover:bg-white/10 transition backdrop-blur-sm flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                    Déjà membre ? Connectez-vous
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce text-white/50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
        </div>
    </section>

    <!-- Bento Grid : Modules de la plateforme -->
    <section id="features" class="py-24 bg-slate-900 relative overflow-hidden">
        <!-- halo décoratif pur CSS (zéro image) -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-6xl mx-auto px-6">
            <div class="text-center mb-14">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-500/30 bg-indigo-500/10 text-indigo-300 text-xs font-semibold uppercase tracking-wider mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                    Une plateforme, quatre modules
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Tout ce dont votre club a besoin</h2>
                <p class="mt-3 text-slate-400 max-w-xl mx-auto">Des outils pensés pour la réalité du terrain : finances, effectifs, calendrier et décision.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <!-- Carte 1 : LARGE — Dashboard analytique (mockup CSS pur) -->
                <div class="bento-card md:col-span-2 p-7 rounded-2xl border border-white/10 bg-slate-800/40 backdrop-blur-xl min-h-[260px] flex flex-col justify-between hover:border-indigo-500/50 hover:bg-slate-800/60 transition-all duration-300 group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-500/15 flex items-center justify-center text-indigo-400 mb-4 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">Tableau de Bord Analytique</h3>
                        <p class="text-slate-400 text-sm">Inscriptions, revenus et taux de présence visualisés en temps réel via Chart.js.</p>
                    </div>
                    <!-- faux graphique en pur CSS (drop-zone future : remplacer par <canvas>) -->
                    <div class="mt-6 flex items-end gap-2 h-20">
                        <div class="flex-1 rounded-t bg-indigo-500/30" style="height:40%"></div>
                        <div class="flex-1 rounded-t bg-indigo-500/50" style="height:70%"></div>
                        <div class="flex-1 rounded-t bg-indigo-500/40" style="height:55%"></div>
                        <div class="flex-1 rounded-t bg-violet-500/60" style="height:90%"></div>
                        <div class="flex-1 rounded-t bg-indigo-500/50" style="height:65%"></div>
                        <div class="flex-1 rounded-t bg-emerald-500/60" style="height:100%"></div>
                    </div>
                </div>

                <!-- Carte 2 : PETITE — Joueurs -->
                <div class="bento-card p-7 rounded-2xl border border-white/10 bg-slate-800/40 backdrop-blur-xl min-h-[260px] flex flex-col justify-between hover:border-violet-500/50 hover:bg-slate-800/60 transition-all duration-300 group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-violet-500/15 flex items-center justify-center text-violet-400 mb-4 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1">Gestion des Joueurs</h3>
                        <p class="text-slate-400 text-sm">Fiches, catégories U8–U18 et contacts parents centralisés.</p>
                    </div>
                    <div class="flex -space-x-2 mt-5">
                        <div class="w-8 h-8 rounded-full bg-violet-600 border-2 border-slate-800"></div>
                        <div class="w-8 h-8 rounded-full bg-indigo-600 border-2 border-slate-800"></div>
                        <div class="w-8 h-8 rounded-full bg-slate-700 border-2 border-slate-800 flex items-center justify-center text-[10px] text-slate-300 font-bold">+12</div>
                    </div>
                </div>

                <!-- Carte 3 : PETITE — Cotisations & PDF -->
                <div class="bento-card p-7 rounded-2xl border border-white/10 bg-slate-800/40 backdrop-blur-xl min-h-[220px] flex flex-col justify-between hover:border-emerald-500/50 hover:bg-slate-800/60 transition-all duration-300 group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/15 flex items-center justify-center text-emerald-400 mb-4 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1">Cotisations & Reçus PDF</h3>
                        <p class="text-slate-400 text-sm">Suivi des paiements et génération de reçus officiels.</p>
                    </div>
                    <div class="mt-4 inline-flex items-center gap-2 text-xs font-semibold text-emerald-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Automatique
                    </div>
                </div>

                <!-- Carte 4 : LARGE — Calendrier & Convocations -->
                <div class="bento-card md:col-span-2 p-7 rounded-2xl border border-white/10 bg-slate-800/40 backdrop-blur-xl min-h-[220px] flex flex-col justify-between hover:border-rose-500/50 hover:bg-slate-800/60 transition-all duration-300 group">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-rose-500/15 flex items-center justify-center text-rose-400 mb-4 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">Calendrier & Convocations Numériques</h3>
                        <p class="text-slate-400 text-sm">Matchs, entraînements et confirmation de présence en un clic par les parents.</p>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-5">
                        <span class="px-3 py-1 rounded-lg bg-rose-500/10 text-rose-300 text-xs font-semibold border border-rose-500/20">⚽ Match</span>
                        <span class="px-3 py-1 rounded-lg bg-emerald-500/10 text-emerald-300 text-xs font-semibold border border-emerald-500/20">🏃 Entraînement</span>
                        <span class="px-3 py-1 rounded-lg bg-slate-700/50 text-slate-300 text-xs font-semibold border border-white/10">✅ Confirmé</span>
                    </div>
                </div>

                <!-- Carte 5 : PLACEHOLDER en pointillés (ta drop-zone V2) -->
                <div class="bento-card p-7 rounded-2xl border border-dashed border-slate-700 bg-slate-900/30 min-h-[220px] flex flex-col items-center justify-center text-center group hover:border-indigo-500/40 hover:bg-slate-900/50 transition-all duration-300">
                    <div class="w-10 h-10 rounded-full border border-dashed border-slate-600 flex items-center justify-center text-slate-500 text-xl mb-3 group-hover:text-indigo-400 group-hover:border-indigo-500/50 transition">+</div>
                    <p class="text-slate-500 text-sm font-medium group-hover:text-slate-300 transition">Emplacement réservé</p>
                    <p class="text-slate-600 text-xs mt-1">Messagerie parents · Paiement mobile (MVola / Orange Money)</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Upcoming Events Preview (Public but Protected Details) -->
    <section id="events" class="py-20 bg-slate-800/50 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">Prochains Rendez-vous</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Event Card 1 -->
                <div class="event-card bg-slate-900 rounded-xl overflow-hidden border border-white/10 hover:border-indigo-500/50 transition cursor-pointer group fade-in-up">
                    <div class="h-2 bg-blue-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-2 py-1 bg-blue-500/20 text-blue-400 text-xs font-bold rounded uppercase">Match</span>
                            <span class="text-slate-400 text-sm">Sam 15 Oct</span>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition">AS Adema vs SportClub</h3>
                        <p class="text-slate-400 text-sm mt-2">Stade Municipal • 15h00</p>
                        
                        <!-- Bouton Protégé -->
                        <div class="mt-4 pt-4 border-t border-white/5">
                            <button onclick="checkAuthAndRedirect('/evenements/1')" class="w-full py-2 bg-slate-800 hover:bg-indigo-600 text-white text-sm font-semibold rounded-lg transition flex items-center justify-center gap-2">
                                Voir les détails
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                 <!-- Event Card 2 -->
                 <div class="event-card bg-slate-900 rounded-xl overflow-hidden border border-white/10 hover:border-green-500/50 transition cursor-pointer group fade-in-up">
                    <div class="h-2 bg-green-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded uppercase">Entraînement</span>
                            <span class="text-slate-400 text-sm">Mer 12 Oct</span>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-green-400 transition">Séance Tactique U14</h3>
                        <p class="text-slate-400 text-sm mt-2">Terrain Annexe • 17h30</p>
                        
                        <!-- Bouton Protégé -->
                        <div class="mt-4 pt-4 border-t border-white/5">
                            <button onclick="checkAuthAndRedirect('/evenements/2')" class="w-full py-2 bg-slate-800 hover:bg-green-600 text-white text-sm font-semibold rounded-lg transition flex items-center justify-center gap-2">
                                Voir les détails
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 py-12 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 text-center text-slate-500 text-sm">
            <p>&copy; {{ date('Y') }} SportClub Portal. Projet de Stage L3 - Inovatic/LaminaCloud.</p>
        </div>
    </footer>

    <!-- Scripts Animation GSAP & Logic -->
    <script>
        gsap.registerPlugin(ScrollTrigger);

       // Hero Entrance Animation (badge inclus)
        const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
        tl.to("#hero-badge",    { y: 0, opacity: 1, duration: 0.6 })
        .to("#hero-title",    { y: 0, opacity: 1, duration: 1 },    "-=0.3")
        .to("#hero-subtitle", { y: 0, opacity: 1, duration: 0.8 },  "-=0.6")
        .to("#hero-buttons",  { y: 0, opacity: 1, duration: 0.8 },  "-=0.6");

        // Scroll Trigger pour les cartes Bento (remplace l'ancien .feature-card)
        gsap.utils.toArray('.bento-card').forEach((card, i) => {
            gsap.from(card, {
                scrollTrigger: card,
                y: 40,
                opacity: 0,
                duration: 0.7,
                delay: (i % 3) * 0.08,   // léger effet d'escalier par colonne
                ease: "power2.out"
            });
        });

        gsap.utils.toArray('.event-card').forEach(card => {
            gsap.from(card, {
                scrollTrigger: card,
                scale: 0.9,
                opacity: 0,
                duration: 0.6
            });
        });

       function checkAuthAndRedirect(url) {
        // On récupère la valeur de la balise meta
        const isAuthMeta = document.querySelector('meta[name="user-authenticated"]');
        
        // On vérifie si la balise existe et si son contenu est "true"
        const isAuthenticated = isAuthMeta && isAuthMeta.content === 'true';

        if (isAuthenticated) {
            // Si connecté, on va directement vers la page détaillée
            window.location.href = url;
        } else {
            // Si non connecté, on redirige vers le login en gardant l'URL cible
            // Laravel utilisera souvent cette info pour rediriger après connexion
            window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(url);
        }
    }
    </script>
</body>
</html>