<?php

namespace App\Models\Enfant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\Blameable;


class Enfant extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'enfants';

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'adresse',
        'image',
        'pere_id',
        'maman_id',
        'allergies',
        'infos_medicales',
        'document_certificat_medical',
        'date_inscription',
        'statut',
        'class_enfant_id',
        'telephone',
    ];
        public function pere()
    {
        return $this->belongsTo(Pere::class, 'pere_id');
    }
        public function maman()
    {
        return $this->belongsTo(Maman::class, 'maman_id');
    }

    public function classEnfant()
    {
        return $this->belongsTo(class_enfants::class, 'class_enfant_id');
    }
    public function abonnements()
    {
        return $this->hasMany(AbonnementEnfant::class, 'enfant_id');
    }

    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }



}
