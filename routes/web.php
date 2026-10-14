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
});

// ==========================================
// ROUTES PROTÉGÉES (Il faut être connecté)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // 0. Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 1. Profil Utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Gestion des Joueurs
    // Note : Si tu ajoutes des détails plus tard (ex: /joueurs/1), cette route couvrira tout
    Route::prefix('joueurs')->name('joueurs.')->group(function () {
        Route::get('/', [JoueurController::class, 'index'])->name('index');
        // Exemple futur : Route::get('/{id}', [JoueurController::class, 'show'])->name('show');
    });
    
    // Alias direct pour compatibilité avec ton ancien code si nécessaire
    // Mais idéalement, utilise route('joueurs.index') dans tes vues maintenant
    
    // 3. Gestion des Cotisations
    Route::prefix('cotisations')->name('cotisations.')->group(function () {
        Route::get('/', [CotisationController::class, 'index'])->name('index');
        Route::post('/{id}/payer', [CotisationController::class, 'payer'])->name('payer');
        Route::get('/{id}/recu', [CotisationController::class, 'recu'])->name('recu');
    });

    // 4. Calendrier des Événements
    Route::get('/evenements', [EvenementController::class, 'index'])->name('evenements.index');

    // 5. Convocations (Actions POST)
    Route::post('/participation/{evenement}/confirmer/{joueur}', [ParticipationController::class, 'confirmer'])->name('participations.confirmer');
    Route::post('/participation/{evenement}/decliner/{joueur}', [ParticipationController::class, 'decliner'])->name('participations.decliner');
    Route::post('/participation/{evenement}/presence/{joueur}', [ParticipationController::class, 'presence'])->name('participations.presence');

});

// Chargement des routes d'authentification Breeze (Login, Register, etc.)
require __DIR__.'/auth.php';

// 🔒 SÉCURITÉ DEV : Bouton magique uniquement en local
if (app()->environment('local')) {
    Route::post('/dev-login', function () {
        $admin = User::where('email', 'admin@sportclub.com')->first();
        if ($admin) {
            Auth::login($admin);
            return redirect('/dashboard'); 
        }
        return back();
    })->name('dev.login');
}