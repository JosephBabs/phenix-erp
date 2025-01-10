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
                    <h4 class="card-title">Paiement</h4>
                </div>
                <div class="table-wrappr card-body">

                    <table class="table" id="paimentHistTable">
                        <thead>
                            <tr>
                                <th>Numéro de Référence</th>
                                <th>Employé</th>
                                <th>Date de prise de poste</th>
                                <th>Date fin de contrat</th>
                                <th>Nombre heure travaillé</th>
                                <th>Salaire Net</th>
                                <th>Date de Paiement</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paiements as $paiement)
                            <tr>
                                <td>{{ $paiement->id }}</td>
                                <td>{{ $paiement->employee->full_name }}</td>
                                <td>{{ $paiement->temps_de_travail_a_payer_debut }}</td>
                                <td>{{ $paiement->temps_de_travail_a_payer_fin }}</td>
                                <td>{{ $paiement->nombre_heure_travaillée }}</td>
                                <td>{{ $paiement->salaire_brut }}</td>
                                <td>{{ $paiement->montant_a_payer }}</td>
                                <td>
                                    {{-- <a href="{{ route('paiements.print', $paiement->id) }}"
                                    class="btn btn-info">Imprimer</a> --}}
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
