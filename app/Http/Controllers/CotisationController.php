<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    public function index()
    {
        // On récupère toutes les cotisations ET on charge les infos du joueur en même temps
        $cotisations = Cotisation::with('joueur')->get();

        return view('cotisations.index', compact('cotisations'));
    }

    public function payer ($id){
        $cotisation = Cotisation::findOrfail($id);
        $cotisation ->update ([
            'statut'=> 'paye',
            'date_paiement'=> now(),
        ]);
    return redirect()->route('cotisations.index')->with('success','Lacotisation a été payé avec succès!');
    }
}