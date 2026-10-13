<x-app-layout>
    <!-- En-tête de la page -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white">Bienvenue, Admin ! 👋</h2>
        <p class="text-slate-400 mt-1">Voici un aperçu de l'activité de votre club aujourd'hui.</p>
    </div>

    <!-- Cartes de statistiques (Grid de 3 colonnes) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Carte 1 : Joueurs -->
        <div class="bg-slate-800/40 backdrop-blur-xl p-6 rounded-2xl border border-white/10 shadow-lg">
            <h3 class="text-slate-400 text-sm font-medium uppercase tracking-wider">Joueurs inscrits</h3>
            <p class="text-4xl font-extrabold text-white mt-3">42</p>
            <p class="text-green-400 text-xs mt-2">+3 cette semaine</p>
        </div>

        <!-- Carte 2 : Cotisations -->
        <div class="bg-slate-800/40 backdrop-blur-xl p-6 rounded-2xl border border-white/10 shadow-lg">
            <h3 class="text-slate-400 text-sm font-medium uppercase tracking-wider">Cotisations en retard</h3>
            <p class="text-4xl font-extrabold text-red-400 mt-3">5</p>
            <p class="text-slate-500 text-xs mt-2">À relancer d'urgence</p>
        </div>

        <!-- Carte 3 : Prochain match -->
        <div class="bg-slate-800/40 backdrop-blur-xl p-6 rounded-2xl border border-white/10 shadow-lg">
            <h3 class="text-slate-400 text-sm font-medium uppercase tracking-wider">Prochain match</h3>
            <p class="text-2xl font-bold text-blue-400 mt-3">Samedi 14h00</p>
            <p class="text-slate-500 text-xs mt-2">Contre les Aigles de la Ville</p>
        </div>

    </div>

    <!-- Zone de contenu vide pour le futur -->
    <div class="bg-slate-800/40 backdrop-blur-xl p-8 rounded-2xl border border-white/10 min-h-[300px] flex items-center justify-center">
        <p class="text-slate-500 text-lg">Ici s'afficheront bientôt les derniers résultats des matchs et les actualités du club.</p>
    </div>

</x-app-layout>