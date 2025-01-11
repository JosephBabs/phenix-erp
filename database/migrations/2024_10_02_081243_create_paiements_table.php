<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('paiements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees');
        $table->date('temps_de_travail_a_payer_debut');
        $table->date('temps_de_travail_a_payer_fin');
        $table->integer('nombre_heure_travaillée');
        $table->integer('heures_supplementaire')->nullable();
        $table->integer('nombre_heure_assignée'); // Ensure this is defined
        $table->decimal('salaire_brut', 10, 2);
        $table->decimal('montant_a_payer', 10, 2);
        // $table->decimal('taxe', 5, 2); // Add this line if it's missing
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
