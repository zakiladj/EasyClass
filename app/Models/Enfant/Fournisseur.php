<?php

namespace App\Models\Enfant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\Blameable;


class Fournisseur extends Model
{

    use HasFactory;
    use Blameable;
    protected $table = 'fournisseurs';
    protected $fillable = [
        'nom_commercial',
        'raison_sociale',
        'type',
        'telephone',
        'telephone_secondaire',
        'email',
        'site_web',
        'adresse',
        'ville',
        'banque',
        'rib',
        'baridimob',
        'categorie',
        'note',
        'is_active',
        'created_by',
        'updated_by',

    ];
     protected $attributes = [
        'type' => 'entreprise',
        'is_active' => true,
    ];
    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
        public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }
    public function charges()
    {
        return $this->hasMany(Charge::class);
    }
}
