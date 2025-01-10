<?php

// app/Models/PaySlip.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'gross_salary',
        'total_taxes',
        'net_salary',
        'payment_date',
        'reference_number',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
