@extends('navbar')

@section('content')
    <div class="container mt-5">
        <a type="button" class="btn btn-primary" style="background-color: #4CAF50; color: white;" href="{{ route('personnel.create') }}">Ajouter</a>
        <br>
        <div class="card">
            <div class="card-header" style="background-color: #4CAF50; color: white;">
                Liste des personnels
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
                    <tr style="background-color: #3F51B5; color: white;">
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">CarteID</th>
                        <th scope="col">Horaire</th>
                        <th scope="col">Email</th>
                        <th scope="col">C Journalier</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($personnels as $personnel)
                        <tr>
                            <td>{{ $personnel->id }}</td>
                            <td>{{ $personnel->nom }}</td>
                            <td>{{ $personnel->prenom }}</td>
                            <td>{{ $personnel->telephone }}</td>
                            <td>{{ $personnel->carte_identite }}</td>
                            <td>{{ $personnel->horaires_travail }}</td>
                            <td>{{ $personnel->email }}</td>
                            <td>{{ $personnel->cjm }}</td>
                            <td>
                                <a href="{{ route('personnel.edit', $personnel->id) }}" class="btn" style="background-color: #2196F3; color: white;">Modifier</a>
                                <form action="{{ route('personnel.destroy', $personnel->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background-color: #F44336; color: white;">Supprimer</button>
                                </form>
                                <a href="{{ route('personnel.generateQrCode', ['id' => $personnel->id]) }}" class="btn" style="background-color: #607D8B; color: white;">
                                    Générer QR Code
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Aucun personnel trouvé.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $personnels->links() }}
            </div>
        </div>
    </div>
@endsection
