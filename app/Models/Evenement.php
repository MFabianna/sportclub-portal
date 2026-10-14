<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable=['titre','type','date_heure','lieu','convocation_envoyee'];
    protected $casts=[
        'date_heure'=>'datetime',
        'convocation_envoyee'=>'boolean',
    ];

   /**
     * Relation Many-to-Many avec les Joueurs via la table participations
     */
    public function joueurs()
    {
        return $this->belongsToMany(
            Joueur::class,         
            'participations',      
            'evenement_id',        
            'joueur_id'             
        )
        ->withPivot('present', 'reponse') 
        ->withTimestamps(); 
    }
}
