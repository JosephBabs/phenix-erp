<?php

namespace App\Http\Controllers;
use App\Models\Tax;
use App\Models\PaySlip;

use App\Models\{Employee, Salary, PaymentRequest, StaffApplication};

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        return view('admin.views.index');
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
        return view('admin.views.pages.paiements');
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
