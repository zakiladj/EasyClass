<?php

namespace App\Models\Enfant;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blameable;

class EcritureComptable extends Model
{
    use Blameable;

    protected $table = 'ecritures_comptables';

    protected $fillable = [
        'type',
        'categorie_id',
        'amount',
        'entry_date',
        'source_type',
        'source_id',
        'notes',
    ];

    protected $casts = [
        'entry_date' => 'datetime',
        'amount'     => 'decimal:2',
    ];

    // التصنيف
    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    // مصدر العملية (ChildPayment / Expense / EmployeePayment...)
    public function source()
    {
        return $this->morphTo(__FUNCTION__, 'source_type', 'source_id');
    }

    // (اختياري) علاقات audit لو تحب تعرض اسم من أنشأ/عدّل

    public function creator(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function updater(){
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
}
