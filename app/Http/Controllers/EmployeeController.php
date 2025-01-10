<?php

namespace App\Http\Controllers;
use App\Models\Tax;
use App\Models\PaySlip;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\{Employee, Salary, PaymentRequest, StaffApplication};

class EmployeeController extends Controller
{
    public function index()
    {

        $employees = Employee::all();
        // Récupérer les données des taxes
        $taxes = Tax::all();

        // Récupérer les bulletins de salaire
        $paySlips = PaySlip::all();

        $user = Auth::user();
        return view('employees', ['userName' => $user->name], compact('employees', 'taxes', 'paySlips'));
    }


    public function create()
    {
        $user = Auth::user();
        return view('employees_create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'employee_id' => 'required|string|unique:employees,employee_id', // Ensure unique employee_id
            'naissances' => 'required|date', // Date of birth
            'poste' => 'required|string', // Position
            'is_active' => 'required|boolean', // Employment status (active/inactive)
            'type_de_contrat' => 'required|string', // Type of contract (e.g., permanent, temporary)
            'salaire_brut' => 'required|numeric', // Gross salary
            'taxe' => 'required|numeric', // Tax rate
            'date_de_prise_de_service' => 'required|date', // Hire date
            'date_de_fin_de_contrat' => 'nullable|date', // End date of the contract
            'nombre_heure_par_semaine' => 'required|integer', // Number of hours per week
            'bank_account' => 'required|string', // Bank account
        ]);

        // try {
        //     // Create the employee record
        //     Employee::create($request->all());

        //     // Return a success response
        //     return response()->json(['success' => 'Employé ajouté avec succès.']);
        // } catch (\Exception $e) {
        //     // Handle exceptions and return an error response
        //     return response()->json(['error' => 'Une erreur est survenue lors de l\'ajout de l\'employé.'], 500);
        // }

        try {
            $employee = Employee::create($request->all());
            Salary::create([
                'id_employe' => $employee->id,
                'mois' => now()->month,
                'annee' => now()->year,
                'sal_brute' => $validated['salaire_brut'],
                'deduction' => 0,
                'sal_net' => $validated['salaire_brut'],
            ]);


        // return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès.');

            return redirect()
                ->back()
                ->with('success', 'Employé ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de l\'ajout de l\'employé.'+ $e)
                ->withInput();
        }
    }

    public function edit($id)
    {
        // Find the employee by ID
        $employee  = Employee::find($id);

        // Check if the employee exists
        if ($employee) {
            // Return the employee data as a JSON response
            return response()->json([
                'success' => true,
                'data' => $employee
            ]);
        } else {
            // Return an error response if employee not found
            return response()->json([
                'success' => false,
                'message' => 'Employé introuvable.'
            ]);
        }
    }



    public function delete($id)
    {
        // Find the employee by ID
        $employee  = Employee::find($id)->delete();

        // Check if the employee exists
        if ($employee) {
            // Return the employee data as a JSON response
            return response()->json([
                'success' => true,
                'message' => 'Employé supprimé'
            ]);
        } else {
            // Return an error response if employee not found
            return response()->json([
                'success' => false,
                'message' => 'Employé introuvable.'
            ]);
        }
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            // 'employee_id' => 'required|string|unique:employees',
            'naissances' => 'required|date', // Date of birth
            'poste' => 'required|string', // Position
            'is_active' => 'required|integer', // Employment status (active/inactive)
            'type_de_contrat' => 'required|string', // Type of contract (e.g., permanent, temporary)
            'salaire_brut' => 'required|numeric', // Gross salary
            'taxe' => 'required|numeric', // Tax rate
            'date_de_prise_de_service' => 'required|date', // Hire date
            'date_de_fin_de_contrat' => 'required|date', // End date of the contract (nullable)
            'nombre_heure_par_semaine' => 'required|numeric', // Number of hours per week
            'bank_account' => 'required|string',
        ]);

        // $employee->update($request->all());
        try {
            $employee->update($request->all());
            return response()->json(['success' => 'Employé mis à jour avec succès.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de l\'ajout de l\'employé.']);
        }
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès.');
    }
}
