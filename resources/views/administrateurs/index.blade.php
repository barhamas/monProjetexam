@extends('navbar')

@section('content')
    <h2>Tableau de bord Administrateur</h2>
    <p>Bienvenue Mr {{ Auth::user()->nom }} {{ Auth::user()->prenom }}!</p>
    <div>
        <a href="{{ route('administrateurs.informations_personnelles') }}" class="btn btn-primary">Voir mes informations personnelles en tant que Administrateur</a>
        <a href="{{ route('administrateurs.liste_etudiants') }}" class="btn btn-info">Liste des Etudiants</a>
    </div>







    <div class="container mt-5">
        <a type="button" class="btn btn-primary" href="{{ route('administrateurs.create') }}">Ajouter</a>
        <br>
        <div class="card">
            <div class="card-header bg-success">
                Liste des administrateurs
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($administrateurs as $administrateur)
                        <tr>
                            <td>{{ $administrateur->id }}</td>
                            <td>{{ $administrateur->nom }}</td>
                            <td>{{ $administrateur->prenom }}</td>
                            <td>{{ $administrateur->email }}</td>
                            <td>{{ $administrateur->password }}</td>
                            <td>
                                <a href="{{ route('$administrateur.edit', $administrateur->id) }}" class="btn btn-primary">Modifier</a>
                                <form action="{{ route('$administrateur.destroy', $administrateur->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Aucun personnel trouvé.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
