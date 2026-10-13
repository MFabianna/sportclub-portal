<x-app-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-white">Calendrier & Convocations 📅</h2>
            <p class="text-slate-400 mt-1">Gérez les matchs, entraînements et présences.</p>
        </div>
        <!-- Bouton futur pour créer un événement -->
        <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-violet-600 text-white font-bold rounded-lg shadow-lg hover:from-blue-500 hover:to-violet-500 transition">
            + Créer un événement
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($evenements as $evenement)
            <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-white/10 p-6 shadow-lg hover:border-white/20 transition">
                
                <!-- En-tête de la carte -->
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $evenement->titre }}</h3>
                        <p class="text-slate-400 text-sm mt-1">📍 {{ $evenement->lieu }}</p>
                    </div>
                    @if($evenement->type === 'match')
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">⚽ Match</span>
                    @else
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">🏃 Entraînement</span>
                    @endif
                </div>

                <!-- Date -->
                <div class="text-slate-300 mb-6 text-sm">
                    🗓️ <strong>{{ $evenement->date_heure->format('d/m/Y') }}</strong> à {{ $evenement->date_heure->format('H:i') }}
                </div>

                <!-- Liste des joueurs convoqués -->
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Joueurs convoqués</h4>
                <div class="space-y-3">
                    @forelse($evenement->joueurs as $joueur)
                        <div class="flex justify-between items-center bg-slate-900/50 p-3 rounded-lg border border-white/5">
                            <span class="text-white font-medium text-sm">{{ $joueur->prenom }} {{ $joueur->nom }}</span>
                            
                            <div class="flex items-center gap-3">
                                <!-- Badge de statut -->
                                @if($joueur->pivot->reponse === 'confirme')
                                    <span class="text-green-400 text-xs font-bold bg-green-500/10 px-2 py-1 rounded">✅ Confirmé</span>
                                @elseif($joueur->pivot->reponse === 'decline')
                                    <span class="text-red-400 text-xs font-bold bg-red-500/10 px-2 py-1 rounded">❌ Décliné</span>
                                @else
                                    <span class="text-yellow-400 text-xs font-bold bg-yellow-500/10 px-2 py-1 rounded">⏳ En attente</span>
                                @endif

                                <!-- Boutons d'action (Seulement si en attente ou pour changer d'avis) -->
                                <div class="flex gap-1">
                                    <form action="{{ route('participations.confirmer', ['evenement' => $evenement->id, 'joueur' => $joueur->id]) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Confirmer présence" class="px-2 py-1 text-xs font-bold rounded bg-green-600/80 text-white hover:bg-green-500 transition">Oui</button>
                                    </form>
                                    <form action="{{ route('participations.decliner', ['evenement' => $evenement->id, 'joueur' => $joueur->id]) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Décliner invitation" class="px-2 py-1 text-xs font-bold rounded bg-red-600/80 text-white hover:bg-red-500 transition">Non</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm italic">Aucun joueur convoqué pour cet événement.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-12 text-slate-400 bg-slate-800/20 rounded-2xl border border-white/5">
                Aucun événement prévu pour le moment. Cliquez sur "+ Créer un événement" pour commencer.
            </div>
        @endforelse
    </div>
</x-app-layout>