<?php

namespace App\Models\Enfant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maman extends Model
{
    use HasFactory;
    use \App\Traits\Blameable;

    protected $table = 'mamen'; // اسم الجدول

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'adresse',
        'profession',
        'document_piece_identite',
        'document_autorisation',
    ];
    public function enfants()
    {
        return $this->hasMany(Enfant::class, 'maman_id');
    }

    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }


}
