<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'joueur_id',
        'evenement_id',
        'present',
        'reponse',
    ];

    /**
     * Casts : Transforme automatiquement les données venant de la BDD.
     */
    protected $casts = [
        'present' => 'boolean',
    ];

    /**
     * Une participation appartient à un Joueur spécifique.
     */
    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }

    /**
     *: Une participation appartient à un Événement spécifique.
     */
    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
}