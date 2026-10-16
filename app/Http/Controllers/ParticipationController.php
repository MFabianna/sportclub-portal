<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    /**
     * Le joueur confirme sa présence à l'événement
     */
    public function confirmer($evenement_id, $joueur_id)
    {
        Participation::updateOrCreate(
            ['evenement_id' => $evenement_id,
             'joueur_id' => $joueur_id
            ],

            ['reponse' => 'confirme']
        );

        return redirect()->route('evenements.index')->with('success', 'Présence confirmée !');
    }
    /**
     * Le joueur décline la convocation
     */
    public function decliner($evenement_id, $joueur_id)
    {
        Participation::updateOrCreate(
            ['evenement_id' => $evenement_id,
             'joueur_id' => $joueur_id
            ],

            ['reponse' => 'decline']
        );

        return redirect()->route('evenements.index')->with('success', 'Convocation déclinée.');
    }
    /**
     * L'admin marque la presence effective le jour du match
     */
    public function presence($evenement_id,$joueur_id) {
        Participation::updateOrCreate([
            'evenement_id'=>$evenement_id,
            'joueur_id'=>$joueur_id,
        ],
        ['present'=>true,]        
        );
        return redirect()->route('evenements.index')->with('success','Presence enregistrée!');
    }

}
