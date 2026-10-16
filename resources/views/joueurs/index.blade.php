<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- En-tête -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white">Gestion des Joueurs 👥</h2>
                    <p class="text-slate-400 text-sm mt-1">Liste complète des membres du club.</p>
                </div>
                <a href="{{ route('joueurs.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-lg shadow-indigo-500/30">
                    + Ajouter un joueur
                </a>
            </div>

            <!-- Carte Principale -->
            <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg border border-white/10">
                <div class="p-6">
                    
                    <!-- Recherche -->
                    <div class="mb-6">
                        <input type="text" placeholder="Rechercher un joueur par nom ou poste..." class="bg-slate-900 border border-slate-700 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                    </div>

                    <!-- Tableau Dynamique -->
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-300">
                            <thead class="text-xs text-slate-400 uppercase bg-slate-900/50 border-b border-slate-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Photo</th>
                                    <th scope="col" class="px-6 py-3">Nom Complet</th>
                                    <th scope="col" class="px-6 py-3">Catégorie</th>
                                    <th scope="col" class="px-6 py-3">Parent</th>
                                    <th scope="col" class="px-6 py-3">Âge</th>
                                    <th scope="col" class="px-6 py-3">Statut</th>
                                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($joueurs as $joueur)
                                <tr class="bg-slate-800 border-b border-slate-700 hover:bg-slate-700/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                                            {{ substr($joueur->nom, 0, 1) }}{{ substr($joueur->prenom, 0, 1) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                        {{ $joueur->nom }} {{ $joueur->prenom }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-900/50 text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-700/50">{{ $joueur->categorie }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $joueur->parent->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($joueur->date_naissance)->age }} ans
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-green-900/50 text-green-300 text-xs font-medium px-2.5 py-0.5 rounded border border-green-700/50">Actif</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('joueurs.show', $joueur->id) }}" class="font-medium text-indigo-400 hover:text-indigo-300 mr-3">Voir</a>
                                        <a href="{{ route('joueurs.edit', $joueur->id) }}" class="font-medium text-slate-400 hover:text-white">Modifier</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                            <p>Aucun joueur inscrit pour le moment.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>