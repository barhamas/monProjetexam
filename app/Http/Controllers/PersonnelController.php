<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Personnel;
use App\Models\Pointage;
use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PersonnelController extends Controller
{

    /*public function generateSlug() {
    $letters = Str::random(5);
    $numbers = mt_rand(100, 999);
    $slug = $letters . '-' . $numbers;
    return $slug;
    $url = URL::route('personnel.details', ['slug' => 'trois-mots-trois-mots-trois-chiffres']);
    Route::get('/personnel/details/{slug}', [PersonnelController::class, 'show'])->where('slug', '[a-zA-Z]+-[a-zA-Z]+-[a-zA-Z]+[0-9]{3}');

}*/
    public function dashboard()
    {
        $totalEmployees = Personnel::count();
        $totalPointages = Pointage::count();
        $totalPaiements = Paiement::count();
        $totalAdministrateurs = Administrateur::count();
        $personnels = Personnel::all();
        $administrateurs = Administrateur::all();

        return view('/personnel/dashboard', compact('totalEmployees', 'totalPointages', 'totalPaiements', 'totalAdministrateurs', 'personnels', 'administrateurs'));
    }

    public function generateQrCode($id)
    {
        $personnel = Personnel::find($id);
        if (!$personnel) {
            return redirect()->back()->with('error', 'Personnel not found');
        }
        $url = URL::route('personnel.details', ['id' => $id]);
        $qrCode = QrCode::size(200)->generate($url);
        return view('personnel.qrcode', [
            'qrCode' => $qrCode,
            'personnel' => $personnel,
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personnels = Personnel::orderBy('id', 'asc')->paginate(6);
        return view('personnel.index', ['personnels' => $personnels]);
    }
    public function show($id){
        $personnel = Personnel::find($id);
        if (!$personnel) {
            return redirect()->back()->with('error', 'Personnel not found');
        }

        return view('personnel.details', ['personnel' => $personnel]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personnel = new Personnel();
        return view('personnel.create', ['personnel' => $personnel]);
    }

    /**
     * Store a newly created resource in storage.

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'carte_identite' => 'required',
            'horaires_travail' => 'required',
            'email' => 'required|email|unique:personnels',
            'cjm' => 'required|numeric',
        ]);

        $qrCodeContent = $request->email;
        $qrCode = QrCode::format('svg')->size(100)->generate($qrCodeContent);

        $personnel = new Personnel();
        $personnel->nom = $request->nom;
        $personnel->prenom = $request->prenom;
        $personnel->telephone = $request->telephone;
        $personnel->carte_identite = $request->carte_identite;
        $personnel->horaires_travail = $request->horaires_travail;
        $personnel->email = $request->email;
        $personnel->qr_code = $qrCode;
        $personnel->cjm = $request->cjm;
        $personnel->save();

        return redirect()->route('personnel.index')->with('success', 'Personnel ajouté avec succès');
    }
    /**
     * Show the form for editing the specified resource.
     */


    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'carte_identite' => 'required',
            'horaires_travail' => 'required',
            'email' => 'required|email|unique:personnels',
            'cjm' => 'required|numeric',
        ]);

        // Création d'une nouvelle instance de Personnel avec les données du formulaire
        $personnel = new Personnel();
        $personnel->nom = $request->nom;
        $personnel->prenom = $request->prenom;
        $personnel->telephone = $request->telephone;
        $personnel->carte_identite = $request->carte_identite;
        $personnel->horaires_travail = $request->horaires_travail;
        $personnel->email = $request->email;
        $personnel->cjm = $request->cjm;
        $personnel->save();

        // Générer l'URL des détails du personnel
        $url = URL::route('personnel.details', ['id' => $personnel->id]);

        // Redirection avec un message de succès
        return redirect()->route('personnel.index')->with('success', 'Personnel ajouté avec succès')->with('qrCodeUrl', $url);
    }


    public function edit(string $id)
    {
        $personnel = Personnel::find($id);
        return view('personnel.edit', ['personnel' => $personnel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'carte_identite' => 'required',
            'horaires_travail' => 'required',
            'email' => 'required|email|unique:personnels,email,'.$id,
            'cjm' => 'required|numeric',
        ]);

        $personnel = Personnel::find($id);
        $personnel->nom = $request->nom;
        $personnel->prenom = $request->prenom;
        $personnel->telephone = $request->telephone;
        $personnel->carte_identite = $request->carte_identite;
        $personnel->horaires_travail = $request->horaires_travail;
        $personnel->email = $request->email;
        $personnel->cjm = $request->cjm;

        $personnel->save();
        return redirect()->route('personnel.index')->with('success', 'Personnel modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personnel = Personnel::find($id);
        $personnel->delete();
        return redirect()->route('personnel.index')->with('success', 'Personnel supprimé avec succès');
    }
}
