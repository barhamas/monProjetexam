
@extends('navbar')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header bg-success">
                Connexion Etudiant
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('etudiant.login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
