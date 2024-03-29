@extends('navbar')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col">Étudiant</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Telephone</th>
                <th scope="col">File</th>
                <th scope="col">Lettre de Motivation</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($candidatures as $candidature)
                <tr>
                    <td>
                        @if ($candidature->etudiant)
                            {{ $candidature->etudiant->nom ?? 'N/A' }}
                        @else
                            Étudiant inconnu
                        @endif
                    </td>
                    <td>{{ $candidature->etudiant->prenom ?? 'N/A' }}</td>
                    <td>{{ $candidature->etudiant->email ?? 'N/A' }}</td>
                    <td>{{ $candidature->telephone ?? 'N/A' }}</td>
                    <td>
                        @if($candidature->etudiant && $candidature->file)
                            <a href="{{ asset('storage/files/' . $candidature->file) }}" target="_blank">
                                {{ $candidature->file }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>

                    <td>{{ $candidature->lettre_motivation }}</td>
                    <td>{{ $candidature->statut }}</td>
                    <td>
                        @if ($candidature->statut === 'en_attente')
                            <form method="post" action="{{ route('candidatures.update', $candidature->id) }}">
                                @csrf
                                @method('put')
                                <label for="statut-{{ $candidature->id }}">Choose a status:</label>
                                <select class="form-control mb-2" id="statut-{{ $candidature->id }}" name="statut">
                                    <option value="en_attente" {{ $candidature->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="approuve" {{ $candidature->statut === 'approuve' ? 'selected' : '' }}>Approuver</option>
                                    <option value="rejete" {{ $candidature->statut === 'rejete' ? 'selected' : '' }}>Rejeter</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </form>
                        @else
                            {{ $candidature->statut }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
