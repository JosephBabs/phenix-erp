@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Etat des paiements')
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
                        <h2 class="content-header-title float-left mb-0">Paiements</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="/admin/paiements">Paiements</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Etat des paiements</a>
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
                            <li hidden class="nav-item">
                                <a class="nav-link d-flex align-items-center " id="salaire-tab" data-toggle="tab" href="#definition" aria-controls="account" role="tab" aria-selected="true">
                                    <i data-feather="user"></i><span class="d-none d-sm-block">Définition de salaire</span>
                                </a>
                            </li>

                            <li hidden class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="payerEmp-tab" data-toggle="tab" href="#payerEmp" aria-controls="social" role="tab" aria-selected="false">
                                    <i data-feather="dollar-sign"></i><span class="d-none d-sm-block">Payer un employé</span>
                                </a>
                            </li>
                            <li hidden class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="payList-tab" data-toggle="tab" href="#payList" aria-controls="social" role="tab" aria-selected="false">
                                    <i data-feather="list"></i><span class="d-ne d-sm-block">Listes de paiements</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center  active" id="fichepaie-tab" data-toggle="tab" href="#fichePaie" aria-controls="social" role="tab" aria-selected="false">
                                    <i data-feather="file"></i><span class="d-none d-sm-block">Fiches de paie</span>
                                </a>
                            </li>
                            <div class="p-1">
                                <li class="badge badge-pill badge-light-danger" id="errorHolder"></li>
                            </div>
                        </ul>
                        <div class="tab-content">
                            <!-- Account Tab starts -->
                            <div class="tab-pane" id="definition" aria-labelledby="account-tab" role="tabpanel">
                                <!-- users edit media object start -->

                            </div>


                            <!-- Social Tab starts -->
                            <div class="tab-pane active" id="fichePaie" aria-labelledby="social-tab" role="tabpanel">
                                <!-- users edit social form start -->

                                <div class="container mt-4">
                                    <h2 class="mb-4">Créer une fiche de paie</h2>

                                    
                                    <form method="POST">
                                        @csrf

                                        <section class="mb-4">
                                            <div class="row">
                                                <div class="col-md-4">

                                                    <label for="employee_id" class="form-label">Employé</label>
                                                    <select name="employee_id" id="employee_id" class="form-select form-control @error('employee_id') is-invalid @enderror" required>
                                                        <option value="">Sélectionner un Employé</option>
                                                        @foreach($employees as $employee)
                                                        <option value="{{ $employee->id }}">
                                                            {{ $employee->nom  }} {{ $employee->prenoms  }} - Salaire de base: {{ $employee->salaire_base }} - heure assignée: {{ $employee->nombre_heure_assignee }} - Taxe : {{ $employee->taxe_appliquee }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('employee_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Titre</label>
                                                    <select name="title" class="form-select form-control">
                                                        <option disabled selected>Select title</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Grade</label>
                                                    <select name="grade" class="form-select form-control">
                                                        <option disabled selected>Select level</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </section>

                                        <section class="mb-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Salaire de base</label>
                                                    <input type="text" name="base_salary" class="form-control" value="1290000" readonly />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Allocation de logement</label>
                                                    <div class="input-group">
                                                        <input type="text" name="housing_allowance" class="form-control" value="12900" readonly />
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="include_housing" checked />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Indemnité de transport</label>
                                                    <div class="input-group">
                                                        <input type="text" name="transport_allowance" class="form-control" value="6000" readonly />
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="include_transport" checked />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Allocation de services publics</label>
                                                    <div class="input-group">
                                                        <input type="text" name="public_services_allowance" class="form-control" />
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="include_public_services" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <section class="mb-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label">TAX/PAYE</label>
                                                    <input type="text" name="tax_paye" class="form-control" value="28766" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">CNSS</label>
                                                    <input type="text" name="cnss" class="form-control" value="8187" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Total des déductions</label>
                                                    <input type="text" name="total_deductions" class="form-control" value="36953" readonly />
                                                </div>
                                            </div>
                                        </section>

                                        <section>
                                            <div class="mb-3">
                                                <label class="form-label">Salaire net</label>
                                                <input type="text" name="net_salary" class="form-control" readonly />
                                            </div>
                                            <button type="submit" class="btn btn-warning w-100">Créer le bon de salaire</button>
                                        </section>
                                    </form>
                                </div>

                                <!-- users edit social form ends -->
                            </div>

                            <div class="tab-pane" id="payerEmp" aria-labelledby="payer-emp" role="tabpanel">

                            </div>


                            <div class="tab-pane" id="payList" aria-labelledby="pay-list" role="tabpanel">

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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- -->
<!-- BEGIN: Vendor JS-->
<script src="../../../app-assets/vendors/js/vendors.min.js"></script>
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
    $(function() {
        'use strict';

        var dt_debats_table = $('#debatsTable');

        window.table = dt_debats_table;

        if (dt_debats_table.length) {
            var dt_debats = dt_debats_table.DataTable({
                processing: true, // Show loading indicator while processing
                serverSide: false, // Set this to true if using server-side processing
                paging: true, // Enable pagination
                searching: true, // Enable searching
                ordering: true, // Enable sorting
                lengthChange: true, // Allow changing page length
                info: true, // Display table info
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
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
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            }
                        ]
                    },
                    {
                        text: feather.icons['plus'].toSvg({
                            class: 'mr-50 font-small-4'
                        }) + 'Ajouter un sujet',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'data-toggle': 'modal',
                            'data-target': '#modals-slide-in'
                        }
                    }
                ],
                responsive: true,
                language: {
                    search: "Rechercher:",
                    lengthMenu: "Afficher _MENU_ sujets KYC par page",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ sujets",
                    infoEmpty: "Aucun enregistrement disponible",
                    infoFiltered: "(filtré à partir de _MAX_ sujets au total)",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    },
                    emptyTable: "Aucune donnée disponible dans le tableau",
                }
            });
            $('div.head-label').html('<h6 class="mb-0">Liste des sujets de débats</h6>');
            $('#debatsTable_filter input').attr('placeholder', 'Rechercher un sujet...');

        }

    });
</script>

<script>
    window.filterStatus = (tables, status) => {
        table.column(6).search(status).draw();
    };
</script>
@endpush
