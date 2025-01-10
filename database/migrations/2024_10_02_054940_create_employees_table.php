<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_employees_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('employee_id');
            $table->date('naissances');
            $table->string('poste');
            $table->boolean('is_active');
            $table->string('type_de_contrat');
            $table->string('bank_account');
            $table->decimal('salaire_brut', 10, 2);
            $table->decimal('taxe', 5, 2);
            $table->string('num_CNSS');
            $table->date('date_de_prise_de_service');
            $table->date('date_de_fin_de_contrat')->nullable();
            $table->integer('nombre_heure_par_semaine');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
