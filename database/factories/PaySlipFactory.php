<?php
// database/factories/PaySlipFactory.php
namespace Database\Factories;

use App\Models\PaySlip;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaySlipFactory extends Factory
{
    protected $model = PaySlip::class;

    public function definition()
    {
        return [
            'employee_id' => Employee::factory(), // Assuming the Employee model has a factory
            'gross_salary' => $this->faker->numberBetween(50000, 100000),
            'total_taxes' => $this->faker->numberBetween(5000, 15000),
            'net_salary' => $this->faker->numberBetween(35000, 85000),
            'payment_date' => $this->faker->date(),
            'reference_number' => $this->faker->unique()->word(),
        ];
    }
}
