@extends('navbar')

@section('content')
    <div class="container mt-5">
        <br>
        <div class="card">
            <div class="card-header bg-success">
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
                    <tr class="table-primary">
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {window.location.href = "{{ route('administrateurs.principal') }}";}, 2000);
    </script>
@endsection
