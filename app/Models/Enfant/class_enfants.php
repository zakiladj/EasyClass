<?php

namespace App\Models\Enfant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class class_enfants extends Model
{
    //
    use HasFactory;
    use \App\Traits\Blameable;

    protected $table = 'class_enfants';

    protected $fillable = [
        'nom',
        'niveau',
        'capacite',
        'place_disponible',
        'prof_id',
        'description',
        'annee',


    ];

    public function enfants()
    {
        return $this->hasMany(Enfant::class, 'class_enfant_id');
    }
    public function employe()
    {
        return $this->belongsTo(employes::class, 'prof_id');
    }
    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }





}
