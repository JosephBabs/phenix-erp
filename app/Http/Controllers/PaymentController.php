<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function index()
    // {
    //     return view('paiements');
    // }

    public function bonsPaiement()
    {
        return view('bons-paiement');
    }
    public function create($employe_id)
    {

        $user = Auth::user();
        $employees = Employee::findOrFail($employe_id);
        return view('paiements_create', ['userName' => $user->name], compact('employees'));
    }

    public function payer()
    {

        $user = Auth::user();
        $employees = Employee::all();

        // Fetch all employees with their weekly hours and base salary
        // $employees = Employee::all(['id', 'nom', 'prenom', 'nombre_heure_par_semaine', 'salaire_base']);
        return view('paiements_create', ['userName' => $user->name], compact('employees'));
    }

    public function creatPayment(){
        $user = Auth::user();
        $employees = Employee::all();
        return view('paiements.create', ['userName' => $user->name], compact('employees'));
    }

    // Store the payment data in the database
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'temps_de_travail_a_payer_debut' => 'required|date',
            'temps_de_travail_a_payer_fin' => 'required|date|after_or_equal:temps_de_travail_a_payer_debut',
            'nombre_heure_travaillée' => 'required|numeric|min:0',
            'nombre_heure_assignée' => 'required|numeric|min:0',
            'heures_supplementaire' => 'nullable|numeric|min:0',
            'salaire_brut' => 'required|numeric|min:0',
        ]);

        // Fetch the employee's tax rate
        $employee = Employee::findOrFail($validatedData['employee_id']);
        $taxRate = $employee->tax_rate; // Assuming the tax rate column is named "tax_rate"

        // Calculate montant_a_payer
        $montantAPayer = (new Paiement)->calculateNetPay($validatedData['salaire_brut'], $taxRate);

        // Create the paiement record
        Paiement::create([
            'employee_id' => $validatedData['employee_id'],
            'temps_de_travail_a_payer_debut' => $validatedData['temps_de_travail_a_payer_debut'],
            'temps_de_travail_a_payer_fin' => $validatedData['temps_de_travail_a_payer_fin'],
            'nombre_heure_travaillée' => $validatedData['nombre_heure_travaillée'],
            'nombre_heure_assignée' => $validatedData['nombre_heure_assignée'],
            'heures_supplementaire' => $validatedData['heures_supplementaire'] ?? 0,
            'salaire_brut' => $validatedData['salaire_brut'],
            'montant_a_payer' => $montantAPayer,
        ]);

        // Redirect with success message
        return redirect()->route('paiements.payer')->with('success', 'Paiement créé avec succès.');
    }


    // Show a list of all payments
    public function index()
    {
        // Fetch all payments with the associated employee

        $user = Auth::user();
        $paiements = Paiement::with('employee')->get();
        // Load payments with associated employee data
        return view('paiements',['userName' => $user->name], compact('paiements')); // Pass payments to the view

    }

    // Show a specific payment
    public function show($id)
    {
        // Find the payment by ID with the associated employee
        $paiement = Paiement::with('employe')->findOrFail($id);

        return view('paiements', compact('paiement'));
    }

    // Method to print the payment slip (you will need to create this view)
    public function print($id)
    {
        // Find the payment and associated employee for printing
        $paiement = Paiement::with('employe')->findOrFail($id);

        return view('paiements.print', compact('paiement'));
    }
}
