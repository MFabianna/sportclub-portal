<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // On appelle nos 4 seeders personnalisés dans l'ordre logique :
        // 1. D'abord les Utilisateurs et Joueurs (car ils doivent exister avant)
        // 2. Ensuite les Cotisations (qui dépendent des joueurs)
        // 3. Puis les Événements (matchs/entraînements)
        // 4. Enfin les Participations (qui lient joueurs et événements)
        
        $this->call([
            JoueurSeeder::class,
            CotisationSeeder::class,
            EvenementSeeder::class,
            ParticipationSeeder::class,
        ]);
    }
}