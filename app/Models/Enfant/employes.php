<?php

namespace App\Models\Enfant;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class employes extends Model
{
    use HasFactory;
    use \App\Traits\Blameable;
     protected $fillable = [
        'code_barre',
        'nom',
        'prenom',
        'email',
        'image',
        'telephone',
        'telephone2',
        'poste',
        'salaire',
        'statut',
        'niveau',
        'document_piece_identite',
        'diplome',
        'date_embauche',
        'address',
    ];
    public function classes()
    {
        return $this->hasMany(class_enfants::class, 'prof_id');
    }
    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
    public function employeeControls(){
        return $this->hasMany(EmployeeControl::class, 'employe_id');
    }
    public function payments()
        {
            return $this->hasMany(EmployeePayment::class, 'employe_id');
        }
}
