<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On récupère tous les joueurs ET on charge la relation 'parent' en une seule requête (Eager Loading)
        // Cela évite le problème N+1 et permet d'afficher le nom du parent sans erreur.
        $joueurs = Joueur::with('parent')->latest()->get();
        
        // On retourne la vue située dans resources/views/joueurs/index.blade.php
        return view('joueurs.index', compact('joueurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('joueurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // À implémenter plus tard pour sauvegarder les données
        return redirect()->route('joueurs.index')->with('success', 'Joueur créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Joueur $joueur)
    {
        return view('joueurs.show', compact('joueur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Joueur $joueur)
    {
        return view('joueurs.edit', compact('joueur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Joueur $joueur)
    {
        // À implémenter plus tard
        return redirect()->route('joueurs.index')->with('success', 'Joueur mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Joueur $joueur)
    {
        $joueur->delete();
        return redirect()->route('joueurs.index')->with('success', 'Joueur supprimé.');
    }
}