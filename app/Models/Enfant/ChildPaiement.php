<?php

namespace App\Models\Enfant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ChildPaiement extends Model
{
    use HasFactory;
    use \App\Traits\Blameable;

    protected $table = 'child_payments';

    protected $fillable = [
        'pere_id',
        'abonnement_enfant_id',
        'total',
        'payee',
        'rest_pay',
        'date_paiement',
        'note',
    ];

        public function pere()
    {
        return $this->belongsTo(Pere::class);
    }
        public function abonnement()
    {
        return $this->belongsTo(AbonnementEnfant::class, 'abonnement_enfant_id');
    }

    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
    public function ecritures()
        {
            return $this->morphMany(EcritureComptable::class, 'source');
        }

}
