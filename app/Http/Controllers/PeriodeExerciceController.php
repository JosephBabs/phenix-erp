<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeExercice;
use Carbon\Carbon;

class PeriodeExerciceController extends Controller
{
    public function index()
    {
        $periodes = PeriodeExercice::orderBy('date_debut', 'desc')->get();
        return view('admin.periodes.index', compact('periodes'));
    }

    public function getPeriodes()
    {
        $periodes = PeriodeExercice::orderBy('date_debut', 'desc')->get();
        return response()->json($periodes);
    }


    public function store(Request $request)
    {
        $currentMonth = $request->input('month', date('m')); // Use a month passed via request or current month

        // Vérifie si la période d'exercice pour l'année en cours et le mois donné n'existe pas
        if (!PeriodeExercice::whereYear('date_debut', date('Y'))
            ->whereMonth('date_debut', $currentMonth)
            ->exists()) {

            PeriodeExercice::generateFiscalPeriod($currentMonth);

            return redirect()->back()->with('success', 'Période d\'exercice fiscal créée automatiquement pour le mois de ' . Carbon::createFromFormat('m', $currentMonth)->format('F') . '.');
        }

        return redirect()->back()->with('error', 'La période fiscale existe déjà pour ce mois.');
    }


    public function edit($id)
    {
        $periode = PeriodeExercice::findOrFail($id);
        return view('admin.periodes.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $periode = PeriodeExercice::findOrFail($id);
        $periode->update($request->all());

        return redirect()->back()->with('success', 'Période mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $periode = PeriodeExercice::findOrFail($id);
        $periode->delete();

        return redirect()->back()->with('success', 'Période supprimée avec succès.');
    }
}
