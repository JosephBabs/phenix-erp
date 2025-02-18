@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Gestions des paiements')
@section('pageCss')
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat-list.css">

@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Paiments</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Gestions des paiements</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Basic table -->

            <!--/ Basic table -->

            <section class="app-user-edit">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">


                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" id="payerEmp-tab" data-toggle="tab" href="#payerEmp" aria-controls="social" role="tab" aria-selected="false">
                                    <i data-feather="dollar-sign"></i><span class="d-none d-sm-block">Payer un employé</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="payList-tab" data-toggle="tab" href="#payList" aria-controls="social" role="tab" aria-selected="false">
                                    <i data-feather="list"></i><span class="d-ne d-sm-block">Listes de paiements</span>
                                </a>
                            </li>
                            <div class="p-1">
                                <li class="badge badge-pill badge-light-danger" id="errorHolder"></li>
                            </div>
                        </ul>



                        <div class="tab-content">



                            <div class="tab-pane active" id="payerEmp" aria-labelledby="payer-emp" role="tabpanel">
                                <div class="row">
                                    <div class="card col-12 shadow ">
                                        <div class="card-header">
                                            <h4 class="card-title">Formulaire de Paiement</h4>
                                        </div>
                                        <div class="card-body ">
                                            <form method="POST" id="salary-form" action="{{ route('paiements.store') }} ">
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

                                                <div class="row">
                                                    <!-- Employee selection -->
                                                    <div class="col-12 mb-3">
                                                        <label for="employee_id" class="form-label">Employé</label>
                                                        <select name="employee_id" id="employee_id" class="form-select form-control @error('employee_id') is-invalid @enderror" required>
                                                            <option value="">Sélectionner un Employé</option>
                                                            @foreach($employees as $employee)
                                                            <option value="{{ $employee->id }}">
                                                                {{ $employee->nom  }} {{ $employee->prenoms  }} - Salaire de base: {{ $employee->salaire_base }} - Taxe : {{ $employee->taxe_appliquee }}%
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
                                                    <div class="col-4 mb-3">
                                                        <label for="temps_de_travail_a_payer_debut" class="form-label">Début de la période de travail</label>
                                                        <input type="date" class="form-control @error('temps_de_travail_a_payer_debut') is-invalid @enderror" id="temps_de_travail_a_payer_debut" name="temps_de_travail_a_payer_debut" required>
                                                        @error('temps_de_travail_a_payer_debut')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <!-- End Date -->
                                                    <div class="col-4 mb-3">
                                                        <label for="temps_de_travail_a_payer_fin" class="form-label">Fin de la période de travail</label>
                                                        <input type="date" class="form-control @error('temps_de_travail_a_payer_fin') is-invalid @enderror" id="temps_de_travail_a_payer_fin" name="temps_de_travail_a_payer_fin" required>
                                                        @error('temps_de_travail_a_payer_fin')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <!-- Hours Worked -->
                                                    <!-- <div class="col-4 mb-3">
                                                        <label for="nombre_heure_assignée" class="form-label">Nombre d'heures assignées (par mois)</label>
                                                        <input type="number" readonly value="{{ $employee->nombre_heure_assignée }}" class="form-control @error('nombre_heure_assignée') is-invalid @enderror" id="nombre_heure_assignée" name="nombre_heure_assignée" required>
                                                        @error('nombre_heure_assignée')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div> -->



                                                    <!-- Initial Salary (Base Salary) -->
                                                    <div class="col-4 mb-3">
                                                        <label for="salaire_base" class="form-label">Salaire de base</label>
                                                        <input type="number" class="form-control @error('salaire_base') is-invalid @enderror" id="salaire_base" name="salaire_base" readonly>
                                                        @error('salaire_base')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4 mb-3">
                                                        <label for="deduction" class="form-label">Déduction - Taxe (%)</label>
                                                        <input type="text" class="form-control @error('deduction') is-invalid @enderror" id="taxe_deduit" name="deduction" readonly>
                                                        <span class="text-muted" id="resulDeduct"></span>
                                                        @error('deduction')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <!-- Overtime Rate (Optional) -->
                                                    <div class="col-4 mb-3">
                                                        <label for="salaire_brut" class="form-label">Salaire brut TTC</label>
                                                        <input type="number" class="form-control @error('salaire_brut') is-invalid @enderror" id="salaire_brut" name="salaire_brut" readonly>
                                                        @error('salaire_brut')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>


                                                    <!-- <div hidden class="col-4 mb-3">
                                                        <label for="nombre_heure_travaillée" class="form-label">Nombre d'heures travaillées</label>
                                                        <input type="number" class="form-control @error('nombre_heure_travaillée') is-invalid @enderror" id="nombre_heure_travaillée" name="nombre_heure_travaillée" required>
                                                        @error('nombre_heure_travaillée')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    Overtime Hours (Optional)
                                                    <div hidden class="col-4 mb-3">
                                                        <label for="heures_supplementaire" class="form-label">Heures supplémentaires (facultatif)</label>
                                                        <input type="number" class="form-control @error('heures_supplementaire') is-invalid @enderror" id="heures_supplementaire" name="heures_supplementaire">
                                                        @error('heures_supplementaire')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div> -->
                                                    <div class="col-4 mb-3">
                                                        <label for="allocation" class="form-label">Allocation</label>
                                                        <input type="number" placeholder="allocation ex= 10000" class="form-control @error('allocation') is-invalid @enderror" id="allocation" name="allocation">
                                                        @error('allocation')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <!-- prime -->
                                                    <div class="col-12   form-group">
                                                        <label for="prime" class="form-label">Prime</label>
                                                        <br>
                                                        <input type="number" placeholder="Entrer prime ex=20000" class="form-control @error('prime') is-invalid @enderror" id="prime" name="prime">
                                                        <button hidden class="btn btn-primary">+</button>
                                                        @error('prime')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 mb-3">
                                                        <label for="salaire_net" class="form-label">Salaire Net à payer</label>
                                                        <input type="number" class="form-control @error('salaire_brut') is-invalid @enderror" id="salaire_net" name="salaire_net" readonly>
                                                        @error('salaire_net')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <!-- Submit Button -->
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-primary" id="salarypay-submit-button">Créer le Paiement</button>
                                                </div>
                                            </form>


                                            <script>
                                                document.getElementById('employee_id').addEventListener('change', function() {
                                                    const selectedOption = this.options[this.selectedIndex];
                                                    if (selectedOption.value) {
                                                        const salaireBase = selectedOption.text.match(/Salaire de base: (\d+(\.\d{1,2})?)/);
                                                        // const nombreHeureParSemaine = selectedOption.text.match(/heure assignée: (\d+)/);
                                                        const taxe = selectedOption.text.match(/Taxe : (\d+)/);

                                                        if (salaireBase) {
                                                            document.getElementById('salaire_base').value = salaireBase[1];
                                                            document.getElementById('taxe_deduit').value = taxe[1];
                                                            document.getElementById('resulDeduct').textContent = taxe[1] + "% = " + parseFloat(salaireBase[1] * (taxe[1] / 100)).toFixed(2)
                                                            document.getElementById('salaire_brut').value = salaireBase[1] - (salaireBase[1] * (taxe[1] / 100));
                                                            calculateNetSalary();
                                                            // document.getElementById('salaire_net').value = parseFloat(document.getElementById('salaire_brut').value) || 0;
                                                            function calculateNetSalary() {
                                                                const baseAmount = parseFloat(document.getElementById('salaire_brut').value) || 0;
                                                                const allocation = parseFloat(document.getElementById('allocation').value) || 0;
                                                                const prime = parseFloat(document.getElementById('prime').value) || 0;
                                                                document.getElementById('salaire_net').value = (baseAmount + allocation + prime).toFixed(2);
                                                            }

                                                            document.getElementById('allocation').addEventListener('keydown', calculateNetSalary);
                                                            document.getElementById('prime').addEventListener('keydown', calculateNetSalary);
                                                        }


                                                    } else {
                                                        document.getElementById('salaire_base').value = '';
                                                        // document.getElementById('nombre_heure_assignée').value = '';
                                                        document.getElementById('taxe_deduit').value = '';
                                                        document.getElementById('salaire_brut').value = '';
                                                    }
                                                });
                                            </script>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane" id="payList" aria-labelledby="pay-list" role="tabpanel">
                                <div class=" card ">
                                    <!-- Tableau des employés -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-header">
                                                <h4 class="card-title">List de paiements</h4>
                                            </div>
                                            <table class="datatables-basic table" id="paimentHistTable">
                                                <thead>
                                                    <tr>
                                                        <th>Numéro de Référence</th>
                                                        <th class="wrap-i">Nom de l'employé</th>
                                                        <th>Date de prise de poste</th>
                                                        <th>Date fin de contrat</th>
                                                        <th>Salaire Net</th>
                                                        <th>Deduction</th>
                                                        <th>montant à payer</th>
                                                        <th>Date de Paiement</th>
                                                        <th class="wrap-it">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($paiements->reverse() as $paiement)
                                                    <tr>
                                                        <td>{{ $paiement->id }}</td>
                                                        <td class="wrap-it">{{ $paiement->employee->nom }} {{ $paiement->employee->prenoms }}</td>
                                                        <td>{{ $paiement->temps_de_travail_a_payer_debut }}</td>
                                                        <td>{{ $paiement->temps_de_travail_a_payer_fin }}</td>
                                                        <td>{{ $paiement->salaire_base }}</td>
                                                        <td>{{ $paiement->deduction }}%</td>
                                                        <td>{{ $paiement->montant_a_payer }}</td>
                                                        <td>{{ $paiement->created_at }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary text-white btn-sm " type="button" id="actionsMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Actions
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                                                    <li><a class="dropdown-item accept-action" href="#" data-kyc-id="{{ $paiement->id }} ">Modifier</a></li>
                                                                    <li><a class="dropdown-item reject-action" href="#" data-kyc-id="{{ $paiement->id  }}}">Supprimer</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Social Tab ends -->
                        </div>
                    </div>
                </div>
            </section>




        </div>
    </div>
</div>

@endsection



@push('scripts')
<!-- Bootstrap CSS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    $(document).on('click', '.nav-link', function() {
        const tabId = $(this).attr('href'); // Get the href (e.g., #tab2)
        window.location.hash = tabId; // Set it as the URL hash
    });

    $(document).ready(function() {
        const hash = window.location.hash; // Get the current URL hash
        if (hash) {
            // Find the tab with the corresponding href
            const tabTrigger = document.querySelector(`a[href="${hash}"]`);
            if (tabTrigger) {
                const tab = new bootstrap.Tab(tabTrigger); // Create a Bootstrap Tab instance
                tab.show(); // Show the tab
            }
        }
    });
</script>

<script>
    // toastr.success("holla");
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- -->
<!-- BEGIN: Vendor JS-->
<!-- <script src="../../../app-assets/vendors/js/vendors.min.js"></script> -->
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<!-- BEGIN: Page JS-->
<!-- <script src="/app-assets/js/scripts/tables/table-datatables-basic.js"></script> -->
<!-- END: Page JS-->
<script>
    function filterDropdown(input) {
        const dropdown = input.closest('.custom-dropdown');
        const filter = input.value.toLowerCase();
        const options = dropdown.querySelectorAll('.option');

        // Show dropdown
        dropdown.classList.add('active');

        // Filter options
        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(filter) ? '' : 'none';
        });

        // Close dropdown if input is empty
        if (filter === '') {
            dropdown.classList.remove('active');
        }
    }

    // Event listener for selecting options
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('option')) {
            const dropdown = e.target.closest('.custom-dropdown');
            const searchInput = dropdown.querySelector('.search-input');
            searchInput.value = e.target.textContent; // Set the selected value
            dropdown.classList.remove('active'); // Close dropdown
        } else if (!e.target.closest('.custom-dropdown')) {
            // Close all dropdowns if clicked outside
            document.querySelectorAll('.custom-dropdown').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });
</script>

<script>
    $(function() {
        'use strict';

        var dt_debats_table = $('#paimentHistTable');

        window.table = dt_debats_table;

        if (dt_debats_table.length) {
            var dt_debats = dt_debats_table.DataTable({
                processing: true, // Show loading indicator while processing
                serverSide: false,
                responsive: true, // Set this to true if using server-side processing
                paging: true, // Enable pagination
                searching: true, // Enable searching
                ordering: true, // Enable sorting
                lengthChange: true, // Allow changing page length
                info: true, // Display table info
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                columnDefs: [{
                    targets: [8],
                    orderable: false,
                    className: 'text-center',
                    responsivePriority: 1
                }],
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [{
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle mr-2',
                    text: feather.icons['share'].toSvg({
                        class: 'font-small-4 mr-50'
                    }) + 'Exporter',
                    buttons: [{
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 7, 8, 9]
                            }
                        }
                    ]
                }],
                language: {
                    search: "Rechercher:",
                    lengthMenu: "Afficher _MENU_ employés par page",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ employés",
                    infoEmpty: "Aucun enregistrement disponible",
                    infoFiltered: "(filtré à partir de _MAX_ employés au total)",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    },
                    emptyTable: "Aucune donnée disponible dans le tableau",
                }
            });
            $('div.head-label').html('<h6 class="mb-0">Liste des paiments</h6>');
            $('#paimentHistTable_filter input').attr('placeholder', 'Rechercher un paiement...');

        }

    });
</script>

<script>

</script>
@endpush
