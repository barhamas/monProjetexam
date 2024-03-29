@extends('navbar')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header bg-success">
                Modifier un personnel
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('administrateurs.update', $administrateur->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group form-control-lg">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $administrateur->nom) }}" required>
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $administrateur->prenom) }}" required>
                        @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group form-control-lg">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $administrateur->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-control-lg">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="cjm" class="form-control @error('password') is-invalid @enderror" value="{{ old('password', $administrateur->password) }}" required>
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
