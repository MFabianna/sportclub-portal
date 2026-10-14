<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- En-tête de page -->
            <div class="flex justify-between items-center bg-slate-800/40 backdrop-blur-xl p-6 rounded-2xl border border-white/10 shadow-lg">
                <div>
                    <h2 class="text-3xl font-bold text-white tracking-tight">Calendrier & Convocations 📅</h2>
                    <p class="text-slate-400 mt-1 text-sm">Gérez les matchs, entraînements et confirmez les présences.</p>
                </div>
                <button disabled class="opacity-50 cursor-not-allowed px-4 py-2 bg-gradient-to-r from-blue-600 to-violet-600 text-white font-bold rounded-lg shadow-lg">
                    + Créer un événement
                </button>
            </div>

            <!-- Grille des événements -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                @forelse($evenements as $evenement)
                    
                    <!-- Carte Événement -->
                    <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden shadow-xl hover:border-white/20 transition-all duration-300 group">
                        
                        <!-- Bandeau supérieur coloré selon le type -->
                        <div class="h-2 w-full {{ $evenement->type === 'match' ? 'bg-blue-500' : 'bg-green-500' }}"></div>

                        <div class="p-6">
                            <!-- Titre et Type -->
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-white leading-tight">{{ $evenement->titre }}</h3>
                                    <p class="text-slate-400 text-sm mt-1 flex items-center gap-1">
                                         {{ $evenement->lieu }}
                                    </p>
                                </div>
                                
                                @if($evenement->type === 'match')
                                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">⚽ Match</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full bg-green-500/20 text-green-400 border border-green-500/30">🏃 Entraînement</span>
                                @endif
                            </div>

                            <!-- Date et Heure -->
                            <div class="mb-6 p-3 bg-slate-900/50 rounded-lg border border-white/5 flex items-center gap-3">
                                <div class="text-center min-w-[60px]">
                                    <div class="text-2xl font-black text-white leading-none">{{ $evenement->date_heure->format('d') }}</div>
                                    <div class="text-xs text-slate-400 uppercase font-bold">{{ $evenement->date_heure->translatedFormat('M') }}</div>
                                </div>
                                <div class="h-10 w-px bg-slate-700"></div>
                                <div>
                                    <div class="text-sm font-semibold text-white">{{ $evenement->date_heure->format('H:i') }}</div>
                                    <div class="text-xs text-slate-400">{{ $evenement->date_heure->dayName }}</div>
                                </div>
                            </div>

                            <!-- Liste des Joueurs Convoqués -->
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                                Effectif ({!! $evenement->joueurs->count() !!})
                            </h4>

                            <div class="space-y-2 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                @forelse($evenement->joueurs as $joueur)
                                    
                                    <div class="flex justify-between items-center p-3 bg-slate-900/30 rounded-lg border border-white/5 hover:bg-slate-900/50 transition">
                                        
                                        <!-- Info Joueur -->
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold shadow-inner">
                                                {{ substr($joueur->prenom, 0, 1) }}{{ substr($joueur->nom, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-white">{{ $joueur->prenom }} {{ $joueur->nom }}</p>
                                                <p class="text-xs text-slate-500">{{ $joueur->categorie }}</p>
                                            </div>
                                        </div>

                                        <!-- Statut et Actions -->
                                        <div class="flex items-center gap-2">
                                            
                                            <!-- Badge Statut Actuel (Version Glassmorphism propre) -->
                                            @if($joueur->pivot->reponse === 'confirme')
                                                <span class="hidden md:inline-block text-xs font-bold text-green-400 bg-green-500/10 px-2 py-1 rounded border border-green-500/20 mr-2">✅ Confirmé</span>
                                            @elseif($joueur->pivot->reponse === 'decline')
                                                <span class="hidden md:inline-block text-xs font-bold text-red-400 bg-red-500/10 px-2 py-1 rounded border border-red-500/20 mr-2">❌ Décliné</span>
                                            @else
                                                <span class="hidden md:inline-block text-xs font-bold text-yellow-400 bg-yellow-500/10 px-2 py-1 rounded border border-yellow-500/20 mr-2">⏳ Attente</span>
                                            @endif

                                            <!-- Boutons d'action (Appellent les fonctions JS définies en bas) -->
                                            <button onclick="confirmPresence('{{ route('participations.confirmer', ['evenement' => $evenement->id, 'joueur' => $joueur->id]) }}')" 
                                                    class="p-1.5 rounded-md bg-green-600/20 text-green-400 hover:bg-green-600 hover:text-white transition border border-green-600/30" 
                                                    title="Confirmer présence">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            </button>

                                            <button onclick="declineInvitation('{{ route('participations.decliner', ['evenement' => $evenement->id, 'joueur' => $joueur->id]) }}')" 
                                                    class="p-1.5 rounded-md bg-red-600/20 text-red-400 hover:bg-red-600 hover:text-white transition border border-red-600/30" 
                                                    title="Décliner invitation">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>

                                        </div>
                                    </div>

                                @empty
                                    <div class="text-center py-6 text-slate-500 italic text-sm bg-slate-900/20 rounded-lg border border-dashed border-white/10">
                                        Aucun joueur convoqué pour cet événement.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                @empty
                    <!-- État Vide Global -->
                    <div class="col-span-2 text-center py-16 bg-slate-800/20 rounded-2xl border border-white/5">
                        <div class="mx-auto w-16 h-16 bg-slate-700/50 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-lg font-medium text-white">Aucun événement prévu</h3>
                        <p class="text-slate-400 mt-1">Créez votre premier match ou entraînement pour commencer.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    
    <!-- Charger SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function confirmPresence(url) {
            Swal.fire({
                title: 'Confirmer la présence ?',
                text: "Vous allez valider la participation de ce joueur.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981', /* Vert Tailwind */
                cancelButtonColor: '#64748b',   /* Gris Slate */
                confirmButtonText: 'Oui, confirmer',
                cancelButtonText: 'Annuler',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    
                    form.appendChild(csrfInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function declineInvitation(url) {
            Swal.fire({
                title: 'Décliner l\'invitation ?',
                text: "Ce joueur sera marqué comme absent.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', /* Rouge Tailwind */
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Oui, décliner',
                cancelButtonText: 'Annuler',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    
                    form.appendChild(csrfInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
    
    <!-- Style scrollbar personnalisé pour la liste des joueurs -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</x-app-layout>