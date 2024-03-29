@extends('navbar')

@section('content')
    <div class="container mt-5">
        <a type="button" class="btn" style="background-color: #4CAF50; color: white;" href="{{ route('pointage.create') }}">Ajouter</a>
        <br>
        <div class="card">
            <div class="card-header" style="background-color: #4CAF50; color: white;">
                Liste des pointages
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
                        <th>ID</th>
                        <th>Personnel</th>
                        <th>Date</th>
                        <th>Heure d'arrivée</th>
                        <th>Heure de départ</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pointages as $pointage)
                        <tr>
                            <td>{{ $pointage->id }}</td>
                            <td>{{ $pointage->personnel->nom }} {{ $pointage->personnel->prenom }}</td>
                            <td>{{ $pointage->date }}</td>
                            <td>{{ $pointage->heure_arr }}</td>
                            <td>{{ $pointage->heure_dep }}</td>
                            <td>
                                <a href="{{ route('pointage.edit', $pointage->id) }}" class="btn" style="background-color: #2196F3; color: white;">Modifier</a>
                                <form action="{{ route('pointage.destroy', $pointage->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background-color: #F44336; color: white;">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
