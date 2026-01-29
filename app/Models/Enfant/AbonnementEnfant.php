<?php

namespace App\Models\Enfant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbonnementEnfant extends Model
{
    use HasFactory;
    use \App\Traits\Blameable;

    protected $table = 'abonnement_enfants';

    protected $fillable = [
        'enfant_id',
        'abonement_id',
        'date_debut',
        'date_fin',
        'date_paiement',
        'montant',
        'etat',
    ];
      public function enfant()
        {
            return $this->belongsTo(Enfant::class);
        }
        public function abonnement()
        {
            return $this->belongsTo(Abonnement::class, 'abonement_id');
        }
        public function payments()
        {
            return $this->hasMany(ChildPaiement::class);
        }
        public function creator(){
            return $this->belongsTo(\App\Models\User::class, 'created_by');
        }
        public function updater(){
            return $this->belongsTo(\App\Models\User::class, 'updated_by');
        }

}
