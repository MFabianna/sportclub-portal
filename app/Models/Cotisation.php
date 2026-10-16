<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;
    protected $fillable =[
        'joueur_id','montant','mois_concerne','statut','date_paiement'
    ];

    //Relations
     public function joueur () {
            return $this->belongsTo(Joueur::class);
        }
}
