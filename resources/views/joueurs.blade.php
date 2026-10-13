<x-app-layout>
    <!-- En-tête de la page -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-white">Gestion des Joueurs 👥</h2>
            <p class="text-slate-400 mt-1">Liste complète des membres du club.</p>
        </div>
        <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-violet-600 text-white font-bold rounded-lg shadow-lg hover:from-blue-500 hover:to-violet-500 transition">
            + Ajouter un joueur
        </button>
    </div>

    <!-- Barre de recherche (Visuelle pour l'instant) -->
    <div class="mb-6">
        <input type="text" placeholder="Rechercher un joueur par nom ou poste..." 
            class="w-full px-4 py-3 bg-slate-800/40 backdrop-blur-xl border border-white/10 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
    </div>

    <!-- Le Tableau des Joueurs -->

        <!-- En-tête du tableau (Thead) -->
    <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-white/10 shadow-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4">Photo</th> 
                    <th class="px-6 py-4">Nom complet</th>
                    <th class="px-6 py-4">Catégorie</th>
                    <th class="px-6 py-4">Parent</th> 
                    <th class="px-6 py-4">Âge</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

        <!-- Corps du tableau (Tbody) -->
        <tbody class="divide-y divide-white/5 text-slate-300">
            @foreach($joueurs as $joueur)
                <tr class="hover:bg-slate-700/30 transition">
                    
                    <!-- Colonne Photo -->
                    <td class="px-6 py-4">
                        @if($joueur->photo_path)
                            <!-- Si la photo existe, on l'affiche -->
                            <img src="{{ asset('storage/' . $joueur->photo_path) }}" alt="Photo" class="w-10 h-10 rounded-full object-cover border-2 border-blue-500">
                        @else
                            <!-- Sinon, on affiche un avatar par défaut avec ses initiales -->
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-600 to-violet-600 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($joueur->prenom, 0, 1)) }}{{ strtoupper(substr($joueur->nom, 0, 1)) }}
                            </div>
                        @endif
                    </td>

                    <!-- Colonne Nom -->
                    <td class="px-6 py-4 font-medium text-white">
                        {{ $joueur->nom }} {{ $joueur->prenom }}
                    </td>

                    <!-- Colonne Catégorie -->
                    <td class="px-6 py-4">{{ $joueur->categorie }}</td>

                    <!-- Colonne Parent (Grâce à la relation Eloquent !) -->
                    <td class="px-6 py-4 text-slate-400">
                        {{ $joueur->parent ? $joueur->parent->name : 'Aucun parent lié' }}
                    </td>

                    <!-- Colonne Âge -->
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($joueur->date_naissance)->age }} ans
                    </td>

                    <!-- Colonne Statut -->
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">
                            Actif
                        </span>
                    </td>

                    <!-- Colonne Actions -->
                    <td class="px-6 py-4 text-right">
                        <button class="text-blue-400 hover:text-white transition mr-3">Voir</button>
                        <button class="text-slate-400 hover:text-white transition">Modifier</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
            </tbody>
        </table>
    </div>
</x-app-layout>