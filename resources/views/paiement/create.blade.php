@extends('navbar')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success">
                Ajouter un paiement
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('paiement.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="personnel_id">Personnel :</label>
                        <select name="personnel_id" id="personnel_id" class="form-control">
                            @foreach ($personnels as $personnel)
                                <option value="{{ $personnel->id }}">{{ $personnel->nom }} {{ $personnel->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_paiement">Date de paiement :</label>
                        <input type="date" name="date_paiement" id="date_paiement" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant :</label>
                        <input type="number" name="montant" id="montant" class="form-control" step="0.01" min="0" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
