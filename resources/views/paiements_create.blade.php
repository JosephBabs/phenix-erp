@extends('layouts.app')

@section('title', 'Payer un employé')
@section('header-title', 'Payer un employé')

@section('content')

<div class="page-view-section page-inner mt--5">
    <div class="row mt--2">
        <div class="card shadow ">
            <div class="card-header">
                <h4 class="card-title">Formulaire de Paiement</h4>
            </div>
            <div class="card-body ">
                <form method="POST" id="salary-form" action="{{ route('paiements.store') }}">
                    @csrf

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- Employee selection -->
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employé</label>
                        <select name="employee_id" id="employee_id" class="form-select form-control @error('employee_id') is-invalid @enderror" required>
                            <option value="">Sélectionner un Employé</option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->full_name }} - Heures/semaine: {{ $employee->nombre_heure_par_semaine }} - Salaire de base: {{ $employee->salaire_brut }}
                            </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div class="mb-3">
                        <label for="temps_de_travail_a_payer_debut" class="form-label">Début de la période de travail</label>
                        <input type="date" class="form-control @error('temps_de_travail_a_payer_debut') is-invalid @enderror" id="temps_de_travail_a_payer_debut" name="temps_de_travail_a_payer_debut" required>
                        @error('temps_de_travail_a_payer_debut')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="temps_de_travail_a_payer_fin" class="form-label">Fin de la période de travail</label>
                        <input type="date" class="form-control @error('temps_de_travail_a_payer_fin') is-invalid @enderror" id="temps_de_travail_a_payer_fin" name="temps_de_travail_a_payer_fin" required>
                        @error('temps_de_travail_a_payer_fin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Hours Worked -->
                    <div class="mb-3">
                        <label for="nombre_heure_assignée" class="form-label">Nombre d'heures assignées</label>
                        <input type="number" readonly  value="{{ $employee->nombre_heure_assignée }}" class="form-control @error('nombre_heure_assignée') is-invalid @enderror" id="nombre_heure_assignée" name="nombre_heure_assignée" required>
                        @error('nombre_heure_assignée')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nombre_heure_travaillée" class="form-label">Nombre d'heures travaillées</label>
                        <input type="number" class="form-control @error('nombre_heure_travaillée') is-invalid @enderror" id="nombre_heure_travaillée" name="nombre_heure_travaillée" required>
                        @error('nombre_heure_travaillée')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Overtime Hours (Optional) -->
                    <div class="mb-3">
                        <label for="heures_supplementaire" class="form-label">Heures supplémentaires (facultatif)</label>
                        <input type="number" class="form-control @error('heures_supplementaire') is-invalid @enderror" id="heures_supplementaire" name="heures_supplementaire">
                        @error('heures_supplementaire')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Initial Salary (Base Salary) -->
                    <div class="mb-3">
                        <label for="salaire_brut" class="form-label">Salaire Brut</label>
                        <input type="number" class="form-control @error('salaire_brut') is-invalid @enderror" id="salaire_brut" name="salaire_brut" readonly>
                        @error('salaire_brut')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" id="salarypay-submit-button">Créer le Paiement</button>
                </form>


                <script>
                    document.getElementById('employee_id').addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        if (selectedOption.value) {
                            const salaireBase = selectedOption.text.match(/Salaire de base: (\d+(\.\d{1,2})?)/);
                            const nombreHeureParSemaine = selectedOption.text.match(/Heures\/semaine: (\d+)/);
                            if (salaireBase) {
                                document.getElementById('salaire_brut').value = salaireBase[1];
                                document.getElementById('nombre_heure_assignée').value = nombreHeureParSemaine[1];
                            }
                        } else {
                            document.getElementById('salaire_brut').value = '';
                            document.getElementById('nombre_heure_assignée').value = '';
                        }
                    });
                </script>


            </div>
        </div>
    </div>
</div>
@endsection
