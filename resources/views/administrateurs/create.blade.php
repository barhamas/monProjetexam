@extends('navbar')

@section('content')
    <div style="margin-top: 50px; margin-left: auto; margin-right: auto; width: 50%;">
        <div style="background-color: #4CAF50; color: white; padding: 10px;">
            <h3 style="margin: 0;">Ajouter un administrateur</h3>
        </div>
        <div style="background-color: #fff; padding: 20px;">
            <form method="POST" action="{{ route('administrateurs.store') }}">
                @csrf

                <div style="margin-bottom: 10px;">
                    <label for="nom" style="margin-bottom: 5px;">Nom</label><br>
                    <input type="text" name="nom" id="nom" style="width: 100%; padding: 8px; box-sizing: border-box;" class="@error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}" required>
                    @error('nom')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 10px;">
                    <label for="prenom" style="margin-bottom: 5px;">Prénom</label><br>
                    <input type="text" name="prenom" id="prenom" style="width: 100%; padding: 8px; box-sizing: border-box;" class="@error('prenom') is-invalid @enderror"
                           value="{{ old('prenom') }}" required>
                    @error('prenom')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 10px;">
                    <label for="email" style="margin-bottom: 5px;">Email</label><br>
                    <input type="email" name="email" id="email" style="width: 100%; padding: 8px; box-sizing: border-box;" class="@error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required>
                    @error('email')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 10px;">
                    <label for="password" style="margin-bottom: 5px;">Mot de passe</label><br>
                    <input type="password" name="password" id="password" style="width: 100%; padding: 8px; box-sizing: border-box;" class="@error('password') is-invalid @enderror" required>
                    @error('password')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; cursor: pointer;">Ajouter</button>
            </form>
        </div>
    </div>
@endsection
