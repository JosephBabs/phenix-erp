<?php

namespace App\Http\Controllers;
use App\Models\Tax;
use App\Models\PaySlip;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Paiement;

use App\Models\{Employee, Memo, Taxe, Salary, PaymentRequest, StaffApplication};

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        $updated_at = now();

        return view('admin.views.index', [
            'updated_at' => $updated_at,
            'employees' => Employee::all(),
            'memos' => Memo::all(),
            'paymentRequests' => PaymentRequest::all(),
            'staffApplications' => StaffApplication::first(),
        ]);
        // return view('admin.views.index');
    }

    public function dashboard()
    {



        $updated_at = now();

        return view('index', [
            'updated_at' => $updated_at,
            'employees' => Employee::all(),
            'memos' => Memo::all(),
            'paymentRequests' => PaymentRequest::all(),
            'staffApplications' => StaffApplication::first(),
        ]);
    }

    public function employeCreer(){

        return view('admin.views.pages.creer_employes');

    }
    public function employes()
    {
        $employees = Employee::all();
        // Récupérer les données des taxes
        $taxes = Tax::all();

        // Récupérer les bulletins de salaire
        $paySlips = PaySlip::all();
        return view('admin.views.pages.employes', compact('employees', 'taxes', 'paySlips'));
    }
    public function paiements()
    {
        $user = Auth::user();
        $employees = Employee::all();
        $paiements = Paiement::all();
        $taxe = Taxe::all();
        return view('admin.views.pages.paiements', compact('employees', 'taxe', 'paiements'));
    }
    public function etats_paiements()
    {
        return view('admin.views.pages.etats_paiements');
    }
    public function taxes_cotisations()
    {
        return view('admin.views.pages.taxes_cotisations');
    }
    public function gestion_conges()
    {
        return view('admin.views.pages.gestion_conges');
    }
    public function notifications()
    {
        return view('admin.views.pages.notifications');
    }
    public function parametres()
    {
        return view('admin.views.pages.parametres');
    }
    public function supports()
    {
        return view('admin.views.pages.supports');
    }
}
