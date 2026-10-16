<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\EvenementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ==========================================
// ROUTES PROTÉGÉES (Il faut être connecté)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // 0. Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 1. Profil Utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Gestion des Joueurs (CRUD complet via resource)
    Route::resource('joueurs', JoueurController::class);

    // 3. Gestion des Événements (CRUD complet via resource)
    Route::resource('evenements', EvenementController::class);

    // 4. Gestion des Cotisations (routes personnalisées)
    Route::prefix('cotisations')->name('cotisations.')->group(function () {
        Route::get('/', [CotisationController::class, 'index'])->name('index');
        Route::post('/{id}/payer', [CotisationController::class, 'payer'])->name('payer');
        Route::get('/{id}/recu', [CotisationController::class, 'recu'])->name('recu');
    });

    // 5. Convocations (Actions POST pour confirmer / décliner / présence)
    Route::prefix('participations')->name('participations.')->group(function () {
        Route::post('/{evenement}/confirmer/{joueur}', [ParticipationController::class, 'confirmer'])->name('confirmer');
        Route::post('/{evenement}/decliner/{joueur}', [ParticipationController::class, 'decliner'])->name('decliner');
        Route::post('/{evenement}/presence/{joueur}', [ParticipationController::class, 'presence'])->name('presence');
    });

});

// Chargement des routes d'authentification Breeze (Login, Register, etc.)
require __DIR__.'/auth.php';

// 🔒 SÉCURITÉ DEV : Connexion rapide admin (uniquement en local)
if (app()->environment('local')) {
    Route::post('/dev-login', function () {
        $admin = User::where('email', 'admin@sportclub.com')->first();
        if ($admin) {
            Auth::login($admin);
            return redirect('/dashboard'); 
        }
        return back()->with('error', 'Aucun compte admin trouvé. Lance le seeder !');
    })->name('dev.login');
}