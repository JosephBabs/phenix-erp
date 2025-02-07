@extends('admin.views.layouts.app')
@section('title', 'Phenix ERP - Etat des paiements')
@section('pageCss')
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat-list.css">


<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
<!-- END: Page CSS-->

<style>

</style>
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
                                <li class="breadcrumb-item"><a href="/admin/etats_paiements">Etat des Paiements</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Bon de paiement</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <div class="card-body invoice-padding pb-0">
                                <!-- Header starts -->
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <img id="logo-img" width="120px" height="auto" src="/images/phenix_logo.png" alt="Logo" />

                                        </div>
                                        <p class="card-text mb-25">Abomey Calavi, Iita</p>
                                        <p class="card-text mb-25">Ms Dimitrius c/245</p>
                                        <p class="card-text mb-0">+229 61654378</p>
                                    </div>
                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            Bon de paiement
                                            <span class="invoice-number">#BNP-00{{ $payslip->id }}PBJ</span>
                                        </h4>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Date :</p>
                                            <p class="invoice-date">{{ now() }}</p>
                                        </div>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Date de paiement:</p>
                                            <p class="invoice-date">{{ $payslip->payment_date }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing" />

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-7 p-0">
                                        <h6 class="mb-2">Payé à:</h6>
                                        <h6 class="mb-25">{{ $employee[0]->etat_civil }} {{ $employee[0]->nom }} {{ $employee[0]->prenoms }}</h6>
                                        <p class="card-text mb-25"><strong> Titre: </strong>{{ $payslip->title ?? '-' }}</p>
                                        <p class="card-text mb-25"><strong>Grade: </strong>{{ $payslip->grade ?? '-' }}</p>
                                        <p class="card-text mb-25" style="word-break: break-all; max-width: 170px;"><strong>Adresse: </strong>{{ $employee[0]->adresse }}</p>
                                        <p class="card-text mb-0"><strong>Contacts: </strong>{{ $employee[0]->telephone }} <br> {{ $employee[0]->email }}</p>
                                        <p class="card-text mb-0"><strong>IFU: </strong>{{ $employee[0]->num_ifu }} </p>
                                    </div>
                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Détails de paiement:</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pr-1">Total Net:</td>
                                                    <td><span class="font-weight-bold">{{ $payslip->net_salary ?? '-' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Nom de banque</td>
                                                    <td>{{ $employee[0]->nom_banque ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">N° de compte</td>
                                                    <td>{{ $employee[0]->compte_bancaire ?? '-' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!-- Invoice Description starts -->
                            <div id="displayResult" class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="py-1">Taxe/allocations description</th>
                                            <th class="py-1">Taux</th>
                                            <th class="py-1">Montant</th>
                                            <th class="py-1">Total déductions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Cotisations et Taxe</p>
                                                <p class="card-text text-nowrap">

                                                </p>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{ $employee[0]->taxe_appliquee }}%</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{ $payslip->total_deductions }}</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{ $payslip->total_deductions }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Allocations</p>
                                                <p class="card-text text-nowrap">Transport</p>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">-</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{ $payslip->transport_allowance }}</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{ $payslip->transport_allowance }}</span>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Allocations</p>
                                                <p class="card-text text-nowrap">logement</p>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">-</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{ $payslip->housing_allowance ?? '-'}}</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{ $payslip->housing_allowance ?? '-' }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="editResult" class="d-none table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="py-1">Taxe/allocations description</th>
                                            <th class="py-1">Taux</th>
                                            <th class="py-1">Montant</th>
                                            <th class="py-1">Total déductions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Cotisations et Taxe</p>
                                            </td>
                                            <td class="py-1">
                                                <input type="number" id="taxRate" class="form-control" value="{{ $employee[0]->taxe_appliquee }}" oninput="calculateTotal()">%
                                            </td>
                                            <td class="py-1">
                                                <input type="text" id="taxAmount" class="form-control" value="{{ $payslip->total_deductions }}" oninput="calculateTotal()">
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold" id="totalDeductions">{{ $payslip->total_deductions }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Allocations</p>
                                                <p class="card-text text-nowrap">Transport</p>
                                            </td>
                                            <td class="py-1">-</td>
                                            <td class="py-1">
                                                <input type="number" id="transportAllowance" class="form-control" value="{{ $payslip->transport_allowance }}" oninput="calculateTotal()">
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold" id="transportTotal">{{ $payslip->transport_allowance }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">Allocations</p>
                                                <p class="card-text text-nowrap">Logement</p>
                                            </td>
                                            <td class="py-1">-</td>
                                            <td class="py-1">
                                                <input type="number" id="housingAllowance" class="form-control" value="{{ $payslip->housing_allowance ?? '-' }}" oninput="calculateTotal()">
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold" id="housingTotal">{{ $payslip->housing_allowance ?? '-' }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>



                            <div class="card-body invoice-padding pb-0">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        <p class="card-text mb-0">
                                            <span class="font-weight-bold">Comptable:</span> <span class="ml-75">Joseph Babatounde</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Salaire de base:</p>
                                                <p class="invoice-total-amount">{{ $employee[0]->base_salary }}</p>
                                            </div>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Allocations</p>
                                                <p class="invoice-total-amount">{{ ($employee[0]->housing_allowance + $employee[0]->transport_allowance) }}</p>
                                            </div>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Taxe:</p>
                                                <p class="invoice-total-amount">{{ $employee[0]->taxe_appliquee }}%</p>
                                            </div>
                                            <hr class="my-50" />
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Total:</p>
                                                <p class="invoice-total-amount">{{ $payslip->net_salary ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Description ends -->

                            <hr class="invoice-spacing" />

                            <!-- Invoice Note starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="font-weight-bold">Note:</span>
                                        <span>Ce fut un plaisir de travailler avec vous</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Note ends -->
                        </div>
                    </div>
                    <!-- /Invoice -->

                    <!-- Invoice Actions -->
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-outline-secondary btn-block btn-download-invoice mb-75">Télécharger</button>
                                <a class="btn btn-outline-secondary btn-block mb-75" href="#" onclick="printInvoice()">
                                    Imprimer
                                </a>
                                <a class="btn btn-outline-secondary btn-block mb-75" href="#" onclick="editBon();"> Modifier </a>
                                <a class="btn btn-outline-secondary btn-block mb-75 d-none" id="saveIn" href="#" onclick="saveBon();"> Enregistrer </a>

                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Actions -->
                </div>
            </section>

            <!-- Send Invoice Sidebar -->

        </div>
    </div>
</div>




@endsection


@push('scripts')
<script>
function editBon(){
    document.getElementById('editResult').classList.remove('d-none');
    document.getElementById('displayResult').classList.add('d-none');
    document.getElementById("saveIn").classList.remove('d-none');
    document.getElementById("bon_id").disabled = false;
    document.getElementById("bon_date").disabled = false;
    document.getElementById("bon_client_id").disabled = false;
    document.getElementById("bon_montant").disabled = false;
}

function saveBon(){
    document.getElementById('editResult').classList.add('d-none');
    document.getElementById('displayResult').classList.remove('d-none');
    document.getElementById("saveIn").classList.add('d-none');
    document.getElementById("bon_id").disabled = true;
    document.getElementById("bon_date").disabled = true;
    document.getElementById("bon_client_id").disabled = true;
    document.getElementById("bon_montant").disabled = true;
    calculateTotal();
}


function calculateTotal() {
    let taxRate = parseFloat(document.getElementById('taxRate').value) || 0;
    let taxAmount = parseFloat(document.getElementById('taxAmount').value) || 0;
    let transportAllowance = parseFloat(document.getElementById('transportAllowance').value) || 0;
    let housingAllowance = parseFloat(document.getElementById('housingAllowance').value) || 0;

    let totalDeductions = taxAmount;
    let totalAllowances = transportAllowance + housingAllowance;
    let baseSalary = parseFloat("{{ $employee[0]->base_salary }}") || 0;
    let netSalary = baseSalary + totalAllowances - totalDeductions;

    document.getElementById('totalDeductions').innerText = totalDeductions.toFixed(2);
    document.getElementById('transportTotal').innerText = transportAllowance.toFixed(2);
    document.getElementById('housingTotal').innerText = housingAllowance.toFixed(2);
    document.getElementById('netSalary').innerText = netSalary.toFixed(2);
}

function printInvoice() {
    let printContent = document.querySelector('.invoice-preview-card').outerHTML;
    let originalContent = document.body.outerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
}
</script>
@endpush
