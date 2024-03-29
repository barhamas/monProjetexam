<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Personnel;
use App\Models\Pointage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    public function generatePDF($id)
    {
        $paiement = Paiement::find($id);
        $pdf = PDF::loadView('paiement.bulletin_salaire', ['paiement' => $paiement]);
        return $pdf->download('bulletin_salaire.pdf');
    }

    public function index()
    {
        $paiements = Paiement::with('personnel')->orderBy('id', 'asc')->paginate(6);
        return view('paiement.index', ['paiements' => $paiements]);
    }

    public function create()
    {
        $personnels = Personnel::all();
        return view('paiement.create', ['personnels' => $personnels]);
    }


     //https://www.akilischool.com/cours/comment-calculer-la-duree-entre-deux-dates-en-laravel
    /*/https://www.developpez.net/forums/d716382/php/langage/calculer-nombre-d-heures-entre-2-dates/
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'personnel_id' => 'required|exists:personnels,id',
            'date_paiement' => 'required|date',
        ]);

        $personnel = Personnel::find($request->personnel_id);
        if (!$personnel) {
            return redirect()->back()->with('error', 'Personnel not found');
        }

        $datesPointages = $personnel->datesPointages();
        $cjm = $personnel->cjm;
        $totalMontant = 0;

        foreach ($datesPointages as $date) {
            $pointage = Pointage::where('personnel_id', $personnel->id)->whereDate('date', $date)->first();
            if ($pointage) {

                $heure_arr = strtotime($pointage->heure_arr);
                $heure_dep = strtotime($pointage->heure_dep);
                $heuresTravaillees = ($heure_dep - $heure_arr) / 3600;

                $montantJour = $heuresTravaillees * $cjm;
                $totalMontant += $montantJour;
            }
        }

        $paiement = new Paiement();
        $paiement->personnel_id = $personnel->id;
        $paiement->date_paiement = $request->date_paiement;
        $paiement->montant = $totalMontant;
        $paiement->save();

        return redirect()->route('paiement.index')->with('success', 'Paiement ajouté avec succès');
    }/

    public function store(Request $request)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'personnel_id' => 'required|exists:personnels,id',
            'date_paiement' => 'required|date',
        ]);

        // Récupérer les données du formulaire
        $personnelId = $request->input('personnel_id');
        $datePaiement = $request->input('date_paiement');

        // Vérifier si des paiements ont déjà été effectués pour ce personnel à cette date
        $paiementExist = Paiement::where('personnel_id', $personnelId)
            ->whereDate('date_paiement', $datePaiement)
            ->exists();

        if ($paiementExist) {
            // Retourner une erreur indiquant que des paiements ont déjà été effectués pour ce personnel à cette date
            return response()->json(['error' => 'Des paiements ont déjà été effectués pour ce personnel à cette date.'], 400);
        }

        // Récupérer les pointages non payés pour ce personnel à cette date
        $pointagesNonPayes = Pointage::where('personnel_id', $personnelId)
            ->whereDate('date', '<=', $datePaiement)
            ->whereNotExists(function ($query) use ($personnelId, $datePaiement) {
                $query->select(DB::raw(1))
                    ->from('paiements')
                    ->whereColumn('pointages.id', 'paiements.pointage_id')
                    ->where('personnel_id', $personnelId)
                    ->whereDate('date_paiement', $datePaiement);
            })
            ->get();

        // Calculer le montant total du paiement
        $montantTotal = 0;
        foreach ($pointagesNonPayes as $pointage) {
            // Calculer la durée de travail en heures
            $heure_arr = strtotime($pointage->heure_arr);
            $heure_dep = strtotime($pointage->heure_dep);
            $dureeTravail = ($heure_dep - $heure_arr) / 3600;

            // Récupérer le CJM du personnel
            $personnel = Personnel::find($personnelId);
            $cjm = $personnel->cjm;

            // Calculer le montant pour ce pointage
            $montant = $dureeTravail * $cjm;

            // Ajouter le montant au total
            $montantTotal += $montant;
        }

        // Créer le paiement
        $paiement = new Paiement();
        $paiement->personnel_id = $personnelId;
        $paiement->date_paiement = $datePaiement;
        $paiement->montant = $montantTotal;
        $paiement->save();

        // Retourner une réponse de succès
        return response()->json(['success' => 'Paiement effectué avec succès.', 'montant_total' => $montantTotal], 200);
    }*/

    public function store(Request $request)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'personnel_id' => 'required|exists:personnels,id',
            'date_paiement' => 'required|date',
        ]);

        // Récupérer les données du formulaire
        $personnelId = $request->input('personnel_id');
        $datePaiement = $request->input('date_paiement');

        // Vérifier si des paiements ont déjà été effectués pour ce personnel à cette date
        $paiementExist = Paiement::where('personnel_id', $personnelId)
            ->whereDate('date_paiement', $datePaiement)
            ->exists();

        if ($paiementExist) {
            // Retourner une erreur indiquant que des paiements ont déjà été effectués pour ce personnel à cette date
            return redirect()->route('paiement.index')->with('error',  'Des paiements ont déjà été effectués pour ce personnel à cette date.');
        }

        // Récupérer la date du dernier paiement pour ce personnel
        $dernierPaiement = Paiement::where('personnel_id', $personnelId)
            ->orderBy('date_paiement', 'desc')
            ->first();

        // Récupérer les pointages non payés pour ce personnel après la date du dernier paiement
        if ($dernierPaiement) {
            $pointagesNonPayes = Pointage::where('personnel_id', $personnelId)
                ->where('date', '>', $dernierPaiement->date_paiement)
                ->get();
        } else {
            // Si aucun paiement précédent n'est trouvé, récupérez tous les pointages pour ce personnel
            $pointagesNonPayes = Pointage::where('personnel_id', $personnelId)->get();
        }


        // Calculer le montant total du paiement
        $montantTotal = 0;
        foreach ($pointagesNonPayes as $pointage) {
            // Calculer la durée de travail en heures
            $heure_arr = strtotime($pointage->heure_arr);
            $heure_dep = strtotime($pointage->heure_dep);
            $dureeTravail = ($heure_dep - $heure_arr) / 3600;

            // Récupérer le CJM du personnel
            $personnel = Personnel::find($personnelId);
            $cjm = $personnel->cjm;

            // Calculer le montant pour ce pointage
            $montant = $dureeTravail * $cjm;

            // Ajouter le montant au total
            $montantTotal += $montant;
        }

        // Créer le paiement
        $paiement = new Paiement();
        $paiement->personnel_id = $personnelId;
        $paiement->date_paiement = $datePaiement;
        $paiement->montant = $montantTotal;
        $paiement->save();

        // Retourner une réponse de succès
        return redirect()->route('paiement.index')->with('success', 'Paiement ajouté avec succès');
    }








    public function edit(string $id)
    {
        $paiement = Paiement::find($id);
        $personnels = Personnel::all();
        return view('paiement.edit', ['paiement' => $paiement, 'personnels' => $personnels]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'personnel_id' => 'required|exists:personnels,id',
            'date_paiement' => 'required|date',
        ]);

        $paiement = Paiement::find($id);
        $paiement->personnel_id = $request->personnel_id;
        $paiement->date_paiement = $request->date_paiement;
        $paiement->montant = $request->montant;
        $paiement->save();

        return redirect()->route('paiement.index')->with('success', 'Paiement modifié avec succès');
    }

    public function destroy(string $id)
    {
        $paiement = Paiement::find($id);
        $paiement->delete();
        return redirect()->route('paiement.index')->with('success', 'Paiement supprimé avec succès');
    }
}
