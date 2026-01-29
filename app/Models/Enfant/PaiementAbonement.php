<?php

namespace App\Models\Enfant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PaiementAbonement extends Model
{
     use HasFactory;
     use \App\Traits\Blameable;

    protected $table = 'paiement_abonement';

    protected $fillable = [
        'abonement_enfant_id',
        'date_paiement',
        'montant_paye',
        'mode_paiement',
        'reference',
        'remarque',
        'etat',
    ];

    // 🔗 Relation avec AbonementEnfant
    public function abonementEnfant()
    {
        return $this->belongsTo(AbonnementEnfant::class, 'abonement_enfant_id');
    }
    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

}
