@extends('navbar')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header bg-success">
                Modifier un personnel
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('personnel.update', $personnel->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group form-control-lg">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $personnel->nom) }}" required>
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $personnel->prenom) }}" required>
                        @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="telephone">Telephone</label>
                        <input type="text" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $personnel->telephone) }}" required>
                        @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="carte_identite">Carte d'identité</label>
                        <input type="text" name="carte_identite" id="carte_identite" class="form-control @error('carte_identite') is-invalid @enderror" value="{{ old('carte_identite', $personnel->carte_identite) }}" required>
                        @error('carte_identite')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="horaires_travail">Horaires de travail</label>
                        <input type="text" name="horaires_travail" id="horaires_travail" class="form-control @error('horaires_travail') is-invalid @enderror" value="{{ old('horaires_travail', $personnel->horaires_travail) }}" required>
                        @error('horaires_travail')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $personnel->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="cjm">CJM</label>
                        <input type="text" name="cjm" id="cjm" class="form-control @error('cjm') is-invalid @enderror" value="{{ old('cjm', $personnel->cjm) }}" required>
                        @error('cjm')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
