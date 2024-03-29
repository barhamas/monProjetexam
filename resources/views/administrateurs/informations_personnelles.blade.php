@extends('navbar')

@section('content')
    <h2>Informations Personnelles</h2>
    <p>Nom: {{ $administrateur->nom }}</p>
    <p>Prénom: {{ $administrateur->prenom }}</p>
    <p>Email: {{ $administrateur->email }}</p>
@endsection
