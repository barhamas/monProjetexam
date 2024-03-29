@extends('navbar')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header bg-success">
                Modifier le pointage
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
                <form action="{{ route('pointage.update', $pointage->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $pointage->personnel->nom }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $pointage->personnel->prenom }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $pointage->personnel->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $pointage->date }}">
                    </div>
                    <div class="form-group">
                        <label for="heure_arr">Heure d'arrivée:</label>
                        <input type="time" class="form-control" id="heure_arr" name="heure_arr" value="{{ date('H:i', strtotime($pointage->heure_arr)) }}">                    </div>
                    <div class="form-group">
                        <label for="heure_dep">Heure de départ:</label>
                        <input type="time" class="form-control" id="heure_dep" name="heure_dep" value="{{ date('H:i', strtotime($pointage->heure_dep)) }}">                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
