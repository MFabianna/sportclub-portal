<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'categorie',
        'photo_path',
        'user_id',
    ];

    // Date_naissance devient un objet Carbon → on peut faire ->age directement
    protected $casts = [
        'date_naissance' => 'date',
    ];

    /**
     * Un joueur est rattaché au compte PARENT via user_id.
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Un joueur a plusieurs cotisations. */
    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }

    /** Un joueur participe à plusieurs événements (via participations). */
    public function evenements()
    {
        return $this->belongsToMany(
            Evenement::class,
            'participations',
            'joueur_id',
            'evenement_id'
        )->withPivot('present', 'reponse')->withTimestamps();
    }
}