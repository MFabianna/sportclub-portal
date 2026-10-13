<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cotisation;
use App\Models\Joueur;

class CotisationSeeder extends Seeder 
{
   public function run(): void {
        // On récupère simplement les 2 premiers joueurs créés dans la base
      $joueurs = Joueur::limit(2)->get();

        if ($joueurs->count() >= 2) {
            // Le premier joueur (ex: Lucas) -> Payé
            Cotisation::create([
                'joueur_id' => $joueurs[0]->id,
                'montant' => 50000,
                'mois_concerne' => 'Octobre 2026',
                'statut' => 'paye',
                'date_paiement' => '2026-10-05',
            ]);

            // Le deuxième joueur (ex: Sarah) -> Impayé
            Cotisation::create([
                'joueur_id' => $joueurs[1]->id,
                'montant' => 50000,
                'mois_concerne' => 'Octobre 2026',
                'statut' => 'impaye',
                'date_paiement' => null,
            ]);
        }   
    }
}