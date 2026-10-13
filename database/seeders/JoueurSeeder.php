<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Joueur;
use Illuminate\Support\Facades\Hash;

class JoueurSeeder extends Seeder
{
    public function run(): void
    {
        // 1. L'administrateur du club
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@sportclub.com',
            'password' => Hash::make('123passWORD'),
            'role' => 'admin',
        ]);

        // 2. Le parent
        $parent = User::create([
            'name' => 'Marc Dupont',
            'email' => 'parent@sportclub.com',
            'password' => Hash::make('PARent001'),
            'role' => 'parent',
        ]);

        // 3. Les enfants du parent
        Joueur::create([
            'nom' => 'Dupont',
            'prenom' => 'Lucas',
            'date_naissance' => '2012-05-14',
            'categorie' => 'U14',
            'photo_path' => null,
            'user_id' => $parent->id,
        ]);

        Joueur::create([
            'nom' => 'Martin',
            'prenom' => 'Sarah',
            'date_naissance' => '2014-09-02',
            'categorie' => 'U12',
            'photo_path' => null,
            'user_id' => $parent->id,
        ]);
    }
}