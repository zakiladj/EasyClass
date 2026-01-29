<?php

namespace App\Models\Enfant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
     use HasFactory;
     use \App\Traits\Blameable;

    protected $table = 'abonnements';

    protected $fillable = [
        'titre',
        'description',
        'duree_jours',
        'prix',
        'frais_inscription',
        'frais_livres',
        'type',
    ];

    public function abonnementsEnfants()
    {
        return $this->hasMany(AbonnementEnfant::class, 'abonement_id');
    }
    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
}


