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
        return view('paiements.create', ['userName' => $user->name], compact('employees'));
    }

    public function creatPayment(){
        $user = Auth::user();
        $employees = Employee::all();
        return view('paiements.create', ['userName' => $user->name], compact('employees'));
    }

    // Store the payment data in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'temps_de_travail_a_payer_debut' => 'required|date',
            'temps_de_travail_a_payer_fin' => 'required|date',
            'nombre_heure_travaillée' => 'required|integer',
            'heures_supplementaire' => 'nullable|integer',
        ]);

        try {
            // Fetch the employee data
            $employee = Employee::findOrFail($validated['employee_id']);

            // Calculate the salary components
            $nombreHeureAssignee = $employee->nombre_heure_par_semaine;
            $salaireBrut = ($employee->salaire_brut / $nombreHeureAssignee) * $validated['nombre_heure_travaillée'];
            $montantAPayer = $salaireBrut * ((100 - $employee->taxe) / 100);

            // Create the payment record
            Paiement::create([
                'employee_id' => $validated['employee_id'],
                'temps_de_travail_a_payer_debut' => $validated['temps_de_travail_a_payer_debut'],
                'temps_de_travail_a_payer_fin' => $validated['temps_de_travail_a_payer_fin'],
                'nombre_heure_travaillée' => $validated['nombre_heure_travaillée'],
                'heures_supplementaire' => $validated['heures_supplementaire'] ?? 0, // Handle null case
                'salaire_brut' => $salaireBrut,
                'montant_a_payer' => $montantAPayer,
            ]);

            // Redirect back to the employee's detail page with a success message
            return redirect()->route('employese.show', $validated['employee_id'])
                             ->with('success', 'Paiement créé avec succès.');

        } catch (\Exception $e) {
            // Handle the error and return a meaningful response
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la création du paiement.']);
        }
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
