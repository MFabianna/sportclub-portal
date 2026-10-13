<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evenement;
use App\Models\Joueur;
use App\Models\Participation;

class ParticipationSeeder extends Seeder
{
    public function run(): void
    {
        $match = Evenement::where('type', 'match')->first();
        $entrainement = Evenement::where('type', 'entrainement')->first();
        $lucas = Joueur::where('prenom', 'Lucas')->first();
        $sarah = Joueur::where('prenom', 'Sarah')->first();

        if ($match && $entrainement && $lucas && $sarah) {
            
            // Lucas au match -> En attente
            Participation::updateOrCreate(
                ['evenement_id' => $match->id, 'joueur_id' => $lucas->id],
                ['reponse' => 'en_attente']
            );

            // Lucas à l'entraînement -> Confirmé
            Participation::updateOrCreate(
                ['evenement_id' => $entrainement->id, 'joueur_id' => $lucas->id],
                ['reponse' => 'confirme']
            );

            // Sarah au match -> Décliné
            Participation::updateOrCreate(
                ['evenement_id' => $match->id, 'joueur_id' => $sarah->id],
                ['reponse' => 'decline']
            );
        }
    }
}