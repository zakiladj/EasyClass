<?php

namespace App\Models\Enfant;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EmployeeControl extends Model
{

      use HasFactory;
        use Blameable;
        protected $table = 'employee_controls';
        protected $fillable = [
        'employe_id',
        'month',
        'year',
        'salary_total',
        'paid_total',
        'rest',
        'advance_total',
        'bonus_total',
        'deductions_total',
        'etat',
        'note',
        'created_by',
        'updated_by',
    ];
        protected $casts = [
        'etat' => 'boolean',
        'salary_total' => 'decimal:2',
        'paid_total' => 'decimal:2',
        'rest' => 'decimal:2',
        'advance_total' => 'decimal:2',
        'bonus_total' => 'decimal:2',
        'deductions_total' => 'decimal:2',
    ];
        public function employes(){
            return $this->belongsTo(\App\Models\Enfant\employes::class, 'employe_id');
        }
        public function creator(){
            return $this->belongsTo(\App\Models\User::class, 'created_by');
        }
        public function updater(){
            return $this->belongsTo(\App\Models\User::class, 'updated_by');
        }
        public function employeePayments(){
            return $this->hasMany(EmployeePayment::class, 'employee_control_id');
        }
}
