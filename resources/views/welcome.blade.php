<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SportClub - Gestion Moderne de Club Sportif</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind via CDN for standalone welcome page simplicity OR use Vite if configured -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- GSAP Library for Animations -->
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
    </style>
</head>
<body class="antialiased">

    <!-- Navbar Simple -->
    <nav class="fixed w-full z-50 bg-slate-900/80 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <span class="text-2xl font-bold tracking-tighter">
                        Sport<span class="text-indigo-400">Club</span>
                    </span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#features" class="text-slate-300 hover:text-white transition">Fonctionnalités</a>
                    <a href="#events" class="text-slate-300 hover:text-white transition">Événements</a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">Connexion</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg shadow-lg btn-glow transition transform hover:-translate-y-0.5">
                        S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative hero-bg min-h-screen flex items-center justify-center pt-16">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent pointer-events-none"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 id="hero-title" class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 opacity-0 translate-y-10">
                Gérez votre club sportif<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">en toute simplicité.</span>
            </h1>
            <p id="hero-subtitle" class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto opacity-0 translate-y-10">
                Plateforme SaaS complète pour l'administration, le suivi des cotisations et la communication avec les parents.
            </p>
            <div id="hero-buttons" class="mt-10 flex justify-center gap-4 opacity-0 translate-y-10">
                <a href="#features" class="px-8 py-3 bg-white text-slate-900 font-bold rounded-full hover:bg-slate-200 transition shadow-xl">
                    Découvrir les modules
                </a>
                <a href="{{ route('login') }}" class="px-8 py-3 border border-white/30 text-white font-bold rounded-full hover:bg-white/10 transition backdrop-blur-sm">
                    Espace Admin
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce text-white/50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-20 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white">Tout ce dont vous avez besoin</h2>
                <p class="mt-4 text-slate-400">Des outils puissants pour administrer votre association sportive.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card glass-card p-8 rounded-2xl hover:border-indigo-500/50 transition duration-300 group">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Gestion des Joueurs</h3>
                    <p class="text-slate-400 leading-relaxed">Fiches détaillées, catégories U10-U18, historique médical et contacts parents centralisés.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card glass-card p-8 rounded-2xl hover:border-green-500/50 transition duration-300 group">
                    <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Suivi Financier</h3>
                    <p class="text-slate-400 leading-relaxed">Automatisation des rappels de cotisation, génération de reçus PDF officiels et tableaux de bord revenus.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card glass-card p-8 rounded-2xl hover:border-purple-500/50 transition duration-300 group">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Calendrier Interactif</h3>
                    <p class="text-slate-400 leading-relaxed">Convocations numériques, confirmation de présence en un clic et notifications push aux parents.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Preview (Dynamic Data Example) -->
    <section id="events" class="py-20 bg-slate-800/50 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">Prochains Rendez-vous</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Hardcoded for demo visual, replace with loop later -->
                <div class="event-card bg-slate-900 rounded-xl overflow-hidden border border-white/10 hover:border-indigo-500/50 transition cursor-pointer group">
                    <div class="h-2 bg-blue-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-2 py-1 bg-blue-500/20 text-blue-400 text-xs font-bold rounded uppercase">Match</span>
                            <span class="text-slate-400 text-sm">Sam 15 Oct</span>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition">AS Adema vs SportClub</h3>
                        <p class="text-slate-400 text-sm mt-2">Stade Municipal • 15h00</p>
                    </div>
                </div>
                 <div class="event-card bg-slate-900 rounded-xl overflow-hidden border border-white/10 hover:border-green-500/50 transition cursor-pointer group">
                    <div class="h-2 bg-green-500"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded uppercase">Entraînement</span>
                            <span class="text-slate-400 text-sm">Mer 12 Oct</span>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-green-400 transition">Séance Tactique U14</h3>
                        <p class="text-slate-400 text-sm mt-2">Terrain Annexe • 17h30</p>
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

    <!-- Scripts Animation GSAP -->
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Hero Entrance Animation
        const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
        
        tl.to("#hero-title", { y: 0, opacity: 1, duration: 1 })
          .to("#hero-subtitle", { y: 0, opacity: 1, duration: 0.8 }, "-=0.5")
          .to("#hero-buttons", { y: 0, opacity: 1, duration: 0.8 }, "-=0.5");

        // Scroll Trigger for Cards
        gsap.utils.toArray('.feature-card').forEach(card => {
            gsap.from(card, {
                scrollTrigger: card,
                y: 50,
                opacity: 0,
                duration: 0.8,
                stagger: 0.2
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
    </script>
</body>
</html>