@extends('layouts.app')

@section('title', 'Paiement')
@section('header-title', 'Paiements')

@section('content')

<div class="page-view-section  page-inner mt--5">
    <div class="panel-header " data-background-color="dark2">
        <div class="page-inner ">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <!-- <h2 class="text-dark pb-2 fw-bold">Employées</h2> -->
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('bons-paiement')  }}" class="sidebar-link btn btn-outline-primary btn-border btn-round mr-2">Gérer les bons de paiements</a>
                    <a href="{{ route('paiements.payer')  }}" class="sidebar-link btn btn-secondary btn-round">Payer un employé</a>
                </div>
            </div>
        </div>
    </div>

    <div class="shadow card mt-5">
        <div class="card-header">
            <h4 class="mb-4">Créer une définition de salaire</h4>
        </div>
        <div class="p-4">
            <form>
                <div class="row g-3">
                    <!-- Titre -->
                    <div class="col-md-4">
                        <label for="titre" class="form-label">Titre</label>
                        <select id="titre" class="form-select">
                            <option selected>Sélectionner une option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                    </div>

                    <!-- Grade -->
                    <div class="col-md-4">
                        <label for="grade" class="form-label">Grade</label>
                        <select id="grade" class="form-select">
                            <option selected>Choisir un grade</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                        </select>
                    </div>

                    <!-- Salaire de base -->
                    <div class="col-md-4">
                        <label for="salaireBase" class="form-label">Salaire de base</label>
                        <input type="number" class="form-control" id="salaireBase" placeholder="Entrer un montant">
                    </div>

                    <!-- Allocation -->
                    <div class="col-md-4">
                        <label for="allocation" class="form-label">Allocation</label>
                        <input type="number" class="form-control" id="allocation" placeholder="Entrer un montant">
                    </div>

                    <!-- Salaire brut -->
                    <div class="col-md-4">
                        <label for="salaireBrut" class="form-label">Salaire brut</label>
                        <input type="number" class="form-control" id="salaireBrut" placeholder="Entrer un montant">
                    </div>

                    <!-- Deductions -->
                    <div class="col-md-4">
                        <label for="deductions" class="form-label">Deductions</label>
                        <input type="number" class="form-control" id="deductions" placeholder="Entrer un montant">
                    </div>

                    <!-- Salaire net -->
                    <div class="col-md-4">
                        <label for="salaireNet" class="form-label">Salaire net</label>
                        <input type="number" class="form-control" id="salaireNet" placeholder="Entrer un montant">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-warning">Créer une définition de salaire</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt--2">
        <div class="col-md-6">
            
        </div>

        <!-- Tableau des employés -->
        <div class="col-md-12 mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">List de paiements</h4>
                </div>
                <div class="table-wrapper card-body">

                    <table class="table" id="paimentHistTable">
                        <thead>
                            <tr>
                                <th>Numéro de Référence</th>
                                <th class="wrap-i">Nom de l'employé</th>
                                <th>Date de prise de poste</th>
                                <th>Date fin de contrat</th>
                                <th>Nombre heure travaillé</th>
                                <th>Salaire Net</th>
                                <th>montant à payer</th>
                                <th>Date de Paiement</th>
                                <th class="wrap-it">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paiements->reverse() as $paiement)
                            <tr>
                                <td>{{ $paiement->id }}</td>
                                <td class="wrap-it">{{ $paiement->employee->full_name }}</td>
                                <td>{{ $paiement->temps_de_travail_a_payer_debut }}</td>
                                <td>{{ $paiement->temps_de_travail_a_payer_fin }}</td>
                                <td>{{ $paiement->nombre_heure_travaillée }}</td>
                                <td>{{ $paiement->salaire_brut }}</td>
                                <td>{{ $paiement->montant_a_payer }}</td>
                                <td>{{ $paiement->created_at }}</td>
                                <td>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("#paimentHistTable").DataTable({
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true,
            lengthMenu: [3, 5, 10, 25, 50, 100, 200],
            responsive: true,
            pageLength: 5,
            buttons: true,
            info: true,
            language: {
                search: "Rechercher:",
                lengthMenu: "Afficher _MENU_ paiements par page",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ paiement(s)",
                infoEmpty: "Aucun enregistrement disponible",
                infoFiltered: "(filtré à partir de _MAX_ paiement(s) au total)",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                },
                emptyTable: "Aucune donnée disponible dans le tableau",
                searchPlaceholder: 'Rechercher dans le tableau...', // Custom placeholder text
                search: 'Rechercher:'
            }
        });
    });
</script>
@endpush
