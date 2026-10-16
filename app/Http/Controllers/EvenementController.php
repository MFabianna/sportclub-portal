<?php

namespace App\Http\Controllers;

use App\Models\Evenement;

class EvenementController extends Controller
{
    //Affichage du calendrier de tous les evenements
    public function index (){
       $evenements=Evenement::with('joueurs')
                    ->orderby('date_heure','asc')
                    ->get();
                    return view('evenements.index',compact('evenements'));
    }
}