<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrateurController extends Controller
{
    public function principal(){
        return view('administrateurs.principal');
    }

    public function dashboard()
    {
        #$administrateur = Auth::guard('admin')->user();
        #return view('administrateurs.dashboard', compact('administrateur'));


        return view('administrateurs.dashboard');
    }


    public function informationsPersonnelles()
    {
        $administrateur = Auth::user();
        return view('administrateurs.informations_personnelles', compact('administrateur'));
    }
























    public function index()
    {
        $administrateurs = Administrateur::all();
        return view('administrateurs.index', compact('administrateurs'));
    }


    public function create()
    {
        $administrateur = new Administrateur();
        return view('administrateurs.create', compact('administrateur'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:administrateurs',
            'password' => 'required',
        ]);
        $request['password'] = bcrypt($request['password']);
        $administrateur = Administrateur::create($request->all());


        Auth::guard('admin')->login($administrateur);

        return redirect()->route('administrateurs.dashboard')->with('success', 'Administrateur créé avec succès');
    }
    public function show(string $id)
    {
        return redirect()->route('administrateurs.dashboard');

    }




    public function edit(string $id)
    {
        $administrateur = Administrateur::find($id);
        return view('administrateurs.edit', compact('administrateur'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:administrateurs,email,' . $id,
            'password' => 'nullable|min:8',
        ]);

        $administrateur = Administrateur::find($id);
        $administrateur->update($request->all());

        return redirect()->route('administrateurs.dashboard')->with('success', 'Administrateur mis à jour avec succès');
    }


    public function destroy(string $id)
    {
        $administrateur = Administrateur::find($id);
        $administrateur->delete();
        return redirect()->route('administrateurs.index')->with('success', 'Administrateur supprimé avec succès');
    }
}
