<x-app-layout>
    <!-- En-tête de la page -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-white">Suivi des Cotisations 💰</h2>
            <p class="text-slate-400 mt-1">Historique des paiements et relances.</p>
        </div>
        <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-violet-600 text-white font-bold rounded-lg shadow-lg hover:from-blue-500 hover:to-violet-500 transition">
            + Enregistrer un paiement
        </button>
    </div>

    <!-- Le Tableau des Cotisations -->
    <div class="bg-slate-800/40 backdrop-blur-xl rounded-2xl border border-white/10 shadow-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4">Joueur</th>
                    <th class="px-6 py-4">Mois concerné</th>
                    <th class="px-6 py-4">Montant</th>
                    <th class="px-6 py-4">Date de paiement</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4 text-right">Actions</th> <!-- NOUVELLE COLONNE -->
                </tr>
            </thead>

           <tbody class="divide-y divide-white/5 text-slate-300">
           @foreach($cotisations as $cotisation)
            <tr class="hover:bg-slate-700/30 transition">
                <!-- Nom du Joueur (grâce à la relation 'with' du contrôleur) -->
                <td class="px-6 py-4 font-medium text-white">
                    {{ $cotisation->joueur->nom }}
                    {{ $cotisation->joueur->prenom }}
                </td>
                
                <td class="px-6 py-4">
                    {{ $cotisation->mois_concerne }}
                </td>
                
                <!-- Montant formaté proprement (ex: 50 000 Ar) -->
                <td class="px-6 py-4">
                    {{ number_format($cotisation->montant, 0, ',', ' ') }} Ar
                </td>
                
                <!-- Date de paiement (affiche un tiret si c'est null) -->
                <td class="px-6 py-4">
                    {{ $cotisation->date_paiement ? \Carbon\Carbon::parse($cotisation->date_paiement)->format('d/m/Y') : '-' }}
                </td>

                <!-- Badge de Statut Dynamique -->
                <td class="px-6 py-4">
                    @if($cotisation->statut === 'paye')
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">
                            ✅ Payé
                        </span>
                    @elseif($cotisation->statut === 'impaye')
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-500/20 text-red-400 border border-red-500/30">
                            ⚠️ Impayé
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                            ⏳ Partiel
                        </span>
                    @endif
                </td>

                <!-- ACTIONS -->
                <td class="px-6 py-4 text-right">
                    @if($cotisation->statut !== 'paye')
                        <!-- Formulaire de paiement -->
                        <form action="{{ route('cotisations.payer', $cotisation->id) }}" method="POST" class="inline-block">
                            @csrf {{-- Sécurité OBLIGATOIRE de Laravel --}}
                            <button type="submit" class="px-3 py-1 text-xs font-bold rounded-lg bg-amber-600 text-white hover:bg-amber-500 transition shadow-lg shadow-amber-600/20">
                                💳 Payer
                            </button>
                        </form>
                    @else
                        <button class="px-3 py-1 text-xs font-bold rounded-lg bg-slate-700 text-slate-300 cursor-not-allowed">
                            📄 Reçu PDF
                        </button>
                    @endif
                </td>

            </tr>
          @endforeach
        </tbody>
        </table>
    </div>
</x-app-layout>