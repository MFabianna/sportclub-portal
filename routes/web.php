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

// Page d'accueil par défaut
Route::get('/', function () {
    return view('welcome');
});

// Le Dashboard (protégé : il faut être connecté pour le voir)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// NOS ROUTES POUR LE PROJET SPORTCLUB
// ==========================================

// 1. Routes des Joueurs
Route::get('/joueurs', [JoueurController::class, 'index'])->name('joueurs');

// 2. Routes des Cotisations
Route::get('/cotisations', [CotisationController::class, 'index'])->name('cotisations');
Route::post('/cotisations/{id}/payer', [CotisationController::class, 'payer'])->name('cotisations.payer');
Route::get('/cotisations/{id}/recu', [CotisationController::class, 'recu'])->name('cotisations.recu'); 
// ==========================================
// ROUTES DU PROFIL (Créées par Laravel Breeze)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //3.Calendrier des évènements
    Route::get('/evenements',[EvenementController::class,'index'])->name('evenements.index');

    //4.Convocation et présence (gérés par ParticipationController)
    Route::post('/participation/{evenement}/confirmer/{joueur}',[ParticipationController::class,'confirmer'])->name('participations.confirmer');
    Route::post('/participation/{evenement}/decliner/{joueur}',[ParticipationController::class,'decliner'])->name('participations.decliner');
    Route::post('/participation/{evenement}/presence/{joueur}',[ParticipationController::class,'presence'])->name('participations.presence');
});

require __DIR__.'/auth.php';

// 🔒 SÉCURITÉ (environnement local), protection des mots de passes contre "php artisan migrate:fresh"
if (app()->environment('local')) {
    Route::post('/dev-login', function () {
        // On cherche l'admin et on le connecte automatiquement
        $admin = User::where('email', 'admin@sportclub.com')->first();
        if ($admin) {
            Auth::login($admin);
            return redirect('/dashboard'); 
        }
        return back();
    })->name('dev.login');
}