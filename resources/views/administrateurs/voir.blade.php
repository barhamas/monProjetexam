@extends('navbar')

@section('content')


    <div class="container">
        <h1 class="mt-5">Admin Dashboard</h1>
        <table class="table mt-5 table-bordered table-striped table-responsive  ">
            <thead>
            <tr>
                <th>Étudiant</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Lettre de Motivation</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Etudiants as $Etudiant)
                <tr>
                    <td>{{ $Etudiant->nom }}</td>
                    <td>{{ $Etudiant->prenom }}</td>
                    <td>{{ $Etudiant->email }}</td>
                    <td>Cliquez sur voir 👉</td>
                    <td class="d-flex justify-content-right">
                        <a href="{{route('administrateurs.liste_etudiants')}}" type="button" class="btn btn-primary">Voir liste_etudiant</a>
                        <form action="" method="post" >
                            @csrf
                            @method('put')
                            <a href="" type="button" class="btn btn-primary">Modifier</a>
                        </form>
                        <form action="" method="post" >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" value="Supprimer" >Supprimer</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endsection
