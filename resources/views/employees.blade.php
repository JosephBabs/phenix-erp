@extends('layouts.app')

@section('title', 'Employés')
@section('header-title', 'Employés')

@section('content')

<div class="page-view-section  page-inner mt--5">
    <div class="panel-header " data-background-color="dark2">
        <div class="page-inner ">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <!-- <h2 class="text-dark pb-2 fw-bold">Employées</h2> -->
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('paiements')  }}" class="sidebar-link btn btn-outline-primary btn-border btn-round mr-2">Gérer les paiements</a>
                    <a href="{{ route('employees.create')  }}" class="sidebar-link btn btn-secondary btn-round">Ajouter un employé</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt--2">
        <div class="col-md-6">
            <!-- <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Statistiques globales</div>
                    <div class="card-category">Informations quotidiennes sur les statistiques du système</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div>
                                <h3 class="fw-bold">{{ $totalEmployees ?? 0 }}</h3>
                            </div>
                            <h6 class="fw-bold mt-3 mb-0">Total des employés</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div>
                                <h3 class="fw-bold">{{ $totalPayed ?? 0 }}</h3>
                            </div>
                            <h6 class="fw-bold mt-3 mb-0">Total payé</h6>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- Tableau des employés -->
        <div class="col-md-12 mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Table des employés</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="employee_table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Poste</th>
                                    <th>Type de contrat</th>
                                    <th>Date de prise de service</th>
                                    <th>Date de Fin de contrat</th>
                                    <th>Heures par semaine</th>
                                    <th>Numero de Compte</th>
                                    <th>Salaire brut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->full_name }}</td>
                                    <td>{{ $employee->poste }}</td>
                                    <td>{{ $employee->type_de_contrat }}</td>
                                    <td>{{ $employee->date_de_prise_de_service }}</td>
                                    <td>{{ $employee->date_de_fin_de_contrat }}</td>
                                    <td>{{ $employee->nombre_heure_par_semaine }}</td>
                                    <td>{{ $employee->bank_account }}</td>
                                    <td>{{ $employee->salaire_brut }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("#employee_table").DataTable({
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
