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

    //Relations
    public function joueurs() {
        return $this->belongsToMany(Joueurs::class,'participation')
                    ->withPivot('present','response')
                    ->withTimestamps();
    }
}
