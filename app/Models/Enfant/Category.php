<?php



namespace App\Models\Enfant;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Blameable;

class Category extends Model
{
    use Blameable;

    protected $fillable = [
        'name',
        'type',
        'note',
        'is_active',
    ];

    /*
    |--------------------------------------------------------------------------
    | العلاقات
    |--------------------------------------------------------------------------
    */

         public function creator(){
            return $this->belongsTo(\App\Models\User::class, 'created_by');
        }
        public function updater(){
            return $this->belongsTo(\App\Models\User::class, 'updated_by');
        }

        public function charges()
        {
            return $this->hasMany(Charge::class);
        }
        public function ecritures()
            {
                return $this->hasMany(EcritureComptable::class, 'categorie_id');
            }


}
