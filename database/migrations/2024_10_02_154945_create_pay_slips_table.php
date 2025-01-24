<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pay_slips_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaySlipsTable extends Migration
{
    public function up()
    {
        Schema::create('pay_slips', function (Blueprint $table) {
            $table->id(); // ID unique généré automatiquement
            $table->foreignId('employee_id')->constrained('employees')
            ->onDelete('cascade'); // ID de l'employé
            // $table->foreignId('taxes')->constrained('employees'); // ID de l'employé
            $table->decimal('gross_salary', 10, 2); // Salaire brut
            $table->decimal('total_taxes', 10, 2); // Total des taxes
            $table->decimal('net_salary', 10, 2); // Salaire net
            $table->date('payment_date'); // Date de paiement
            $table->string('reference_number'); // Numéro de référence de la paie
            $table->timestamps(); // Champs de timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('pay_slips');
    }
}
