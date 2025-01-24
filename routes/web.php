<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CircularController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\PagesController;



use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Employees


    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employees/create_employee', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/create', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'show'])->name('employees.edit');
    Route::put('/employees/{id}/update', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}/delete', [EmployeeController::class, 'destroy'])->name('employees.delete');
    // Route::resource('employees', EmployeeController::class);
    // Route::resource('taxes', TaxController::class);
    // Route::resource('pay-slips', PaySlipController::class);

    Route::get('/admin/employees/creer', [PagesController::class, 'employeCreer'] );
    Route::get('/admin/employes', [PagesController::class, 'employes']);
    Route::get('/admin/paiements', [PagesController::class, 'paiements']);
    Route::get('/admin/etats_paiements', [PagesController::class, 'etats_paiements']);
    Route::get('/admin/taxes_cotisations', [PagesController::class, 'taxes_cotisations']);
    Route::get('/admin/gestion_conges', [PagesController::class, 'gestion_conges']);
    Route::get('/admin/notifications', [PagesController::class, 'notifications']);
    Route::get('/admin/parametres', [PagesController::class, 'parametres']);
    Route::get('/admin/supports', [PagesController::class, 'supports']);


    // Bons de paiement
    Route::get('/bons-paiement', [PaymentController::class, 'bonsPaiement'])->name('bons-paiement');

    // Paiements
    Route::get('/paiements', [PaymentController::class, 'index'])->name('paiements');
    Route::get('/paiements/payer_employe', [PaymentController::class, 'payer'])->name('paiements.payer');
    Route::post('/paiements/payer', [PaymentController::class, 'store'])->name('paiements.store');

    // Notes
    Route::get('/notes', [NoteController::class, 'index'])->name('notes');

    // Circulaires
    Route::get('/circulaires', [CircularController::class, 'index'])->name('circulaires');

    // Entretien
    Route::get('/entretien', [MaintenanceController::class, 'index'])->name('entretien');

    // Ressources
    Route::get('/ressources', [ResourceController::class, 'index'])->name('ressources');

    // Budget de projet
    Route::get('/budget-projet', [BudgetController::class, 'index'])->name('budget-projet');

    // Stocks et inventaires
    Route::get('/stocks-inventaires', [StockController::class, 'index'])->name('stocks-inventaires');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    // Produits
    Route::get('/produits', [ProductController::class, 'index'])->name('produits');

    // Approvisionnement
    Route::get('/approvisionnement', [SupplyController::class, 'index'])->name('approvisionnement');


    Route::get('/', [DashboardController::class, 'index']);
});
