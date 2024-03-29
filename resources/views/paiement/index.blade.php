@extends('navbar')

@section('content')
    <div class="container mt-5">
        <a type="button" class="btn" style="background-color: #4CAF50; color: white;" href="{{ route('paiement.create') }}">Ajouter</a>
        <br>
        <div class="card">
            <div class="card-header" style="background-color: #4CAF50; color: white;">
                Liste des paiements
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
                        <th scope="col">Personnel</th>
                        <th scope="col">Date de paiement</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($paiements as $paiement)
                        <tr>
                            <td>{{ $paiement->id }}</td>
                            <td>{{ $paiement->personnel->nom }} {{ $paiement->personnel->prenom }}</td>
                            <td>{{ $paiement->date_paiement }}</td>
                            <td>{{ $paiement->montant }}</td>
                            <td>
                                <a href="{{ route('paiement.edit', $paiement->id) }}" class="btn" style="background-color: #2196F3; color: white;">Modifier</a>
                                <form action="{{ route('paiement.destroy', $paiement->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background-color: #F44336; color: white;">Supprimer</button>
                                </form>
                                <a href="{{ route('paiement.generatePDF', $paiement->id) }}" class="btn" style="background-color: #607D8B; color: white;">Télécharger PDF</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Aucun paiement trouvé.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $paiements->links() }}
            </div>
        </div>
    </div>
@endsection
