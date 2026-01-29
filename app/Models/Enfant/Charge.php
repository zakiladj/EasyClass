<?php

namespace App\Models\Enfant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\Blameable;

class Charge extends Model
{

    use HasFactory;
    use Blameable;
    protected $table = 'charges';

    protected $fillable = [
        'nom',
        'type_charge',
        'montant',
        'date_charge',
        'vendeur',
        'note',
        'attachment',
    ];

     public function creator(){
            return $this->belongsTo(\App\Models\User::class, 'created_by');
        }
     public function updater(){
            return $this->belongsTo(\App\Models\User::class, 'updated_by');
        }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class,'vendeur');
    }
    public function ecritures()
        {
            return $this->morphMany(EcritureComptable::class, 'source');
        }


}
