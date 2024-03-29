@extends('navbar')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success">
                Générer le bulletin de salaire
            </div>
            <div class="card-body">
                <a href="{{ route('paiement.generatePDF', $paiement->id) }}" class="btn btn-primary">Télécharger le bulletin de salaire</a>
            </div>
        </div>
    </div>
@endsection
