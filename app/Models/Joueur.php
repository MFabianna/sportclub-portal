<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom',
        'prenom',
        'date_naissance',
        'categorie',
        'photo',
        'user_id',
    ];


    // Relation : Un Joueur appartient à un Parent (User)
    public function parent()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // Relation : Un Joueur a plusieurs Cotisations
    public function cotisations()
    {
        return $this->hasMany(\App\Models\Cotisation::class);
    }
    /**
     * Relation N,N : Un joueur participe à plusieurs événements
     */
    public function evenements()
    {
        return $this->belongsToMany(Evenement::class, 'participations')
                    ->withPivot('present', 'reponse')
                    ->withTimestamps();
    }
}
