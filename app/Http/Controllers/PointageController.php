<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use App\Models\Administrateur;
use App\Models\Personnel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointageController extends Controller
{
    public function affiche(){
     return view('affiche');
    }


    public function datesPointages()
    {
        // Récupérer tous les personnels avec leurs pointages
        $personnels = Personnel::with('pointage')->get();

        // Initialiser un tableau pour stocker les dates de pointage pour chaque personne
        $datesPointages = [];

        // Parcourir chaque personnel
        foreach ($personnels as $personnel) {
            // Initialiser un tableau pour stocker les dates de pointage pour cette personne
            $personnelDates = [];

            // Parcourir les pointages de cette personne
            foreach ($personnel->pointage as $pointage) {
                // Ajouter la date de pointage au tableau
                $personnelDates[] = $pointage->date->format('Y-m-d');
            }

            // Ajouter les dates de pointage pour cette personne au tableau général
            $datesPointages[$personnel->nom . ' ' . $personnel->prenom] = $personnelDates;
        }

        // Retourner les dates de pointage pour chaque personne
        return $datesPointages;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $pointages = Pointage::with('personnel')->orderBy('id', 'asc')->paginate(6);
        $pointages = Pointage::all();
        return view('pointage.index', ['pointages' => $pointages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personnels = Personnel::all();
        return view('pointage.create', ['personnels' => $personnels]);
    }


    //https://www.akilischool.com/cours/comment-calculer-la-duree-entre-deux-dates-en-laravel
    //https://www.developpez.net/forums/d716382/php/langage/calculer-nombre-d-heures-entre-2-dates/
    /*public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'date' => 'required|date',
            'heure_arr' => 'required|date_format:H:i',
            'heure_dep' => 'nullable|date_format:H:i|',
        ]);

        $personnel = Personnel::where('email', $request->email)->first();
        if (!$personnel) {
            return redirect()->back()->with('error', 'Employé non trouvé.');
        }
        $existingPointage = Pointage::where('personnel_id', $personnel->id)->whereDate('date', $request->date)->first();

        if ($existingPointage) {
            return redirect()->back()->with('error', 'Un pointage existe déjà pour ce personnel à cette date');
        }

        $heureDepart = $this->calculerHeureDepart($request->heure_arr, $request->heure_dep, $personnel->horaires_travail);

        $pointage = new Pointage();
        $pointage->personnel_id = $personnel->id;
        $pointage->date = $request->date;
        $pointage->heure_arr = $request->heure_arr;
        $pointage->heure_dep = $heureDepart;
        $pointage->save();


        if (auth()->guard('admin')->check()) {
            return redirect()->route('pointage.index')->with('success', 'Pointage ajouté avec succès');
        } elseif (auth()->check()) {
            return redirect()->route('pointage.index')->with('success', 'Pointage ajouté avec succès');
        } else {
            return redirect()->route('pointage.affiche')->with('success', 'Pointage ajouté avec succès');
        }

    }*/

    public function store(Request $request)
    {
        // Valider la requête
        $request->validate([
            'qrCodeUrl' => 'nullable|string', // Changez required à nullable
        ]);

        // Si le champ qrCodeUrl est rempli, utilisez-le, sinon, utilisez le contenu scanné
        $qrCodeContent = $request->filled('qrCodeUrl') ? $request->input('qrCodeUrl') : $request->input('content');

        // Extraire l'ID du personnel de l'URL
        $parsedUrl = parse_url($qrCodeContent);
        $pathParts = explode('/', $parsedUrl['path']);
        $id = end($pathParts);

        // Trouver le personnel par ID
        $personnel = Personnel::find($id);

        if (!$personnel) {
            // Personnel non trouvé, retourner une réponse d'erreur
            return response()->json(['error' => 'Personnel non trouvé.'], 404);
        }

        // Créer le pointage pour ce personnel
        $pointage = new Pointage();
        $pointage->personnel_id = $personnel->id;
        $pointage->date = now()->toDateString(); // Date actuelle
        $pointage->heure_arr = now()->toTimeString(); // Heure actuelle

        // Calculer heure_dep en ajoutant horaires_travail à heure_arr
        $heureDepart = now()->addHours($personnel->horaires_travail)->toTimeString();
        $pointage->heure_dep = $heureDepart;

        $pointage->save();

        if (auth()->guard('admin')->check()) {
            return redirect()->route('pointage.index')->with('success', 'Pointage ajouté avec succès');
        } elseif (auth()->check()) {
            return redirect()->route('pointage.index')->with('success', 'Pointage ajouté avec succès');
        } else {
            return redirect()->route('pointage.affiche')->with('success', 'Pointage ajouté avec succès');
        }
    }









    public function edit(string $id)
    {
        $pointage = Pointage::find($id);
        $personnels = Personnel::all();
        return view('pointage.edit', ['pointage' => $pointage, 'personnels' => $personnels]);
    }



    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'date' => 'required|date',
            'heure_arr' => 'required|date_format:H:i',
            'heure_dep' => 'nullable|date_format:H:i',
        ]);

        $personnel = Personnel::where('email', $request->email)->first();
        if (!$personnel) {
            return redirect()->back()->with('error', 'Employé non trouvé.');
        }

        $pointage = Pointage::find($id);
        $pointage->personnel_id = $personnel->id;
        $pointage->date = $request->date;
        $pointage->heure_arr = $request->heure_arr;
        $pointage->heure_dep = $request->heure_dep; // Utilisez directement l'heure de départ fournie

        $pointage->save();

        return redirect()->route('pointage.index')->with('success', 'Pointage modifié avec succès');
    }

    public function destroy(string $id)
    {
        $pointage = Pointage::find($id);
        $pointage->delete();

        return redirect()->route('pointage.index')->with('success', 'Pointage supprimé avec succès');
    }

}
