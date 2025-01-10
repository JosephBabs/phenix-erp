@extends('layouts.app')

@section('title', 'Ajouter Employé')
@section('header-title', 'Page')

@section('content')

<div class="page-view-section  page-inner mt--5">

    <div class="col-md-12 mt-4">
        <div class="col-md-12 mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Ajouter un nouvel employé</h4>
                </div>
                <div class="card-body">
                    <form id="employee-form" action="{{ route('employees.store') }}" validate method="POST">
                        @csrf
                        <div class="row">
                            <!-- Employee Information -->
                             @error('form')
                                <p>{{ $message }}</p>
                             @enderror
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="full_name">Nom complet</label>
                                    <input required type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}">
                                    @error('full_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="employee_id">ID Employé</label>
                                    <input required type="text" name="employee_id" id="employee_id" class="form-control" value="{{ old('employee_id') }}">
                                    @error('employee_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gross_salary">Salaire brut</label>
                                    <input required type="number" name="salaire_brut" id="salaire_brut" class="form-control" value="{{ old('salaire_brut') }}">
                                    @error('gross_salary')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="naissances">Date de naissance</label>
                                    <input required type="date" name="naissances" id="naissances" class="form-control" value="{{ old('naissances') }}">
                                    @error('naissances')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Employment Details -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="position">Poste</label>
                                    <input required type="text" name="poste" id="poste" class="form-control" value="{{ old('position') }}">
                                    @error('position')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type_de_contrat">Type de contrat</label>
                                    <input required type="text" name="type_de_contrat" id="type_de_contrat" class="form-control" value="{{ old('type_de_contrat') }}">
                                    @error('type_de_contrat')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="taxe">Taxe (%)</label>
                                    <input required type="number" step="0.01" name="taxe" id="taxe" class="form-control" value="{{ old('taxe') }}">
                                    @error('taxe')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="is_active">Statut</label>
                                    <select name="is_active" id="is_active" class="form-select form-control" required>
                                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Actif</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactif</option>
                                    </select>
                                    @error('is_active')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="hire_date">Date d'embauche</label>
                                    <input required type="date" name="date_de_prise_de_service" id="date_de_prise_de_service" class="form-control" value="{{ old('hire_date') }}">
                                    @error('date_de_prise_de_service')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date_de_fin_de_contrat">Date de fin de contrat</label>
                                    <input type="date" name="date_de_fin_de_contrat" id="date_de_fin_de_contrat" class="form-control" value="{{ old('date_de_fin_de_contrat') }}">
                                    @error('date_de_fin_de_contrat')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nombre_heure_par_semaine">Nombre d'heures par semaine</label>
                                    <input required type="number" name="nombre_heure_par_semaine" id="nombre_heure_par_semaine" class="form-control" value="{{ old('nombre_heure_par_semaine') }}">
                                    @error('nombre_heure_par_semaine')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="bank_account">Compte bancaire</label>
                                    <input required type="text" name="bank_account" id="bank_account" class="form-control" value="{{ old('bank_account') }}">
                                    @error('bank_account')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <button type="submit" id="employee-submit-button" class="btn btn-primary mt-3">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
