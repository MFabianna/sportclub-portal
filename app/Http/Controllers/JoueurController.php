<?php

namespace App\Http\Controllers;
use App\Models\Joueur;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    public function index (){
        $joueurs= Joueur::all();
        return view('joueurs', compact('joueurs'));

    }
}
