<?php

// app/Models/Employee.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        




        // $table->string('full_name');
        // $table->date('naissances');
        // $table->string('poste');
        // $table->boolean('is_active');
        // $table->string('type_de_contrat');
        // $table->decimal('salaire_brut', 10, 2);
        // $table->decimal('taxe', 5, 2);
        // $table->date('date_de_prise_de_service');
        // $table->date('date_de_fin_de_contrat')->nullable();
        // $table->integer('nombre_heure_par_semaine');
    ];


    public function paySlips()
    {
        return $this->hasMany(PaySlip::class);
    }

    public function sentMemos()
    {
        return $this->hasMany(Memo::class, 'sent_by');
    }

    public function receivedMemos()
    {
        return $this->hasMany(Memo::class, 'recipient');
    }
}
