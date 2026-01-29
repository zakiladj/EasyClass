<?php

namespace App\Models\Enfant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \App\Traits\Blameable;





class EmployeePayment extends Model
{

    use HasFactory;
    use Blameable;
    protected $table = 'employee_payments';
    protected $fillable = [
        'employee_control_id',
        'employe_id',
        'type_action',
        'amount',
        'payment_date',
        'note',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];
    public function employeeControl(){
        return $this->belongsTo(EmployeeControl::class, 'employee_control_id');
    }
    public function employes(){
        return $this->belongsTo(\App\Models\Enfant\employes::class, 'employe_id');
    }
    public function creator(){
            return $this->belongsTo(\App\Models\User::class, 'created_by');
            }
    public function updater(){
            return $this->belongsTo(\App\Models\User::class, 'updated_by');
        }
    public function employe()
        {
            return $this->belongsTo(employes::class, 'employe_id');
        }

}
