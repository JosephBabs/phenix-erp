@extends('layouts.app')

@section('title', 'Dashboard')
@section('header-title', 'Tableau de bord')

@section('content')
<div class="page-view-section dashboard">
    <!-- Statistics Section -->

    <div class="w-100 mb-4">
        <div class="d-flex" style="gap: 10px;">
            <div class="stat-item ">

                <div class="stat-content">
                    <h3>{{ count($employees) }}</h3>
                    <p>Total des employés</p>
                    <p class="stat-trend"><i class="fa fa-arrow-up"></i> 06 de plus que l'année passée</p>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="stat-item ">

                <div class="stat-content">
                    <h3>{{ number_format($paymentRequests->sum('amount'), 2, ',', ' ') }} €</h3>
                    <p>Paiement global</p>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-euro-sign"></i>
                </div>
            </div>
            <div class="stat-item ">

                <div class="stat-content">
                    <h3>{{ $employees->count('amount') }}</h3>
                    <p>Employés & prestataires
                        enregistrés</p>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-project-diagram"></i>
                </div>
            </div>
            <div class="stat-item ">

                <div class="stat-content">
                    <h3>{{ $staffApplications->services_functionnels ?? 0 }}</h3>
                    <p>Services fonctionnels</p>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-cogs"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">

            <!-- Memos Table -->
            <div class="memos mb-4 p-2 card shadow">
                <h2 class="memo-title">Mémos</h2>
                <div class="table-wrapper">
                    <table id="memos-table" class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Titre</th>
                                <th>Envoyé par</th>
                                <th>Destinataire</th>
                                <th>État</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($memos as $index => $memo)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="sender">{{ Str::limit($memo->title, 20) }}</td>
                                <td>{{ $memo->sender->full_name }}</td>
                                <td>{{ Str::limit($memo->recipient, 20) }}</td>
                                <td class="status {{ strtolower($memo->status) }}">
                                    {{ $memo->status }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <div class="col-md-6">

            <!-- Payment Requests Table -->
            <div class="requests mb-4 p-2 card shadow">
                <h2>Requêtes de paiement</h2>

                <div class="table-wrapper">
                    <table id="payments-tabl" class="table table-wrapper">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Requêtes</th>
                                <th>Date</th>
                                <th>État</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentRequests as $index => $request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $request->request_name }}</td>
                                <td>{{ $request->created_at->format('d/m/Y') }}</td>
                                <td>{{ $request->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <!-- Staff List -->
            <div class="staff-list  mb-4 p-2  card shadow">
                <h2>Staff List</h2>
                <div class="table-wrapper">
                    <table id="staff-table" class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Staff Name</th>
                                <th>Staff Role</th>
                                <th>Compte</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $index => $employee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $employee->full_name }}</td>
                                <td>{{ $employee->poste }}</td>
                                <td>{{ $employee->bank_account }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <!-- Staff Applications Card -->
            <div class="charts card p-2 shadow">
                <h2>Staff Applications Card</h2>
                <canvas id="staffChart" height="200px"></canvas>
            </div>
        </div>
    </div>




</div>

<script>
    // Staff Applications Chart
    const ctx = document.getElementById('staffChart').getContext('2d');
    const staffChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                label: 'Staff Applications',
                data: [
                    `{{ $staffApplications->pending ?? 0 }}`,
                    `{{ $staffApplications->approved ?? 0 }}`,
                    `{{ $staffApplications->rejected ?? 0 }}`
                ],
                backgroundColor: ['#FDD835', '#4CAF50', '#F44336'],
            }]
        }
    });
</script>
@endsection
