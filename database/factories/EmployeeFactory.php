<?php

// database/factories/EmployeeFactory.php
namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'employee_id' => $this->faker->unique()->randomNumber(5),
            'naissances' => $this->faker->date(), // Date of birth
            'poste' => $this->faker->jobTitle(), // Position
            'is_active' => $this->faker->boolean(), // Employment status (active/inactive)
            'type_de_contrat' => $this->faker->randomElement(['permanent', 'temporary']), // Type of contract
            'salaire_brut' => $this->faker->numberBetween(30000, 100000), // Gross salary
            'taxe' => $this->faker->randomFloat(2, 10, 30), // Tax rate (percentage)
            'date_de_prise_de_service' => $this->faker->date(), // Hire date
            'date_de_fin_de_contrat' => $this->faker->optional()->date(), // End date of the contract (nullable)
            'nombre_heure_par_semaine' => $this->faker->numberBetween(20, 40), // Number of hours per week
            'bank_account' => $this->faker->bankAccountNumber(), // Bank account
        ];
    }
}
