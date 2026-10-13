<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evenement;

class EvenementSeeder extends Seeder
{
    public function run(): void
    {
        Evenement::create([
            'titre' => 'Match amical vs AS Adema',
            'type' => 'match',
            'date_heure' => now()->addDays(5)->setHour(15), 
            'lieu' => 'Stade municipal d\'Antananarivo',
            'convocation_envoyee' => true,
        ]);

        Evenement::create([
            'titre' => 'Entraînement tactique',
            'type' => 'entrainement',
            'date_heure' => now()->addDays(2)->setHour(17), 
            'lieu' => 'Terrain du club',
            'convocation_envoyee' => true,
        ]);
    }
}