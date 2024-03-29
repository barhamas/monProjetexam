<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<header class="p-3 bg-dark lg bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="{{ asset('storage/isii.jpeg') }}" alt="Logo" style="width: 40px;" class="rounded-pill">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item"><a href="{{ route('administrateurs.principal') }}" class="nav-link active" aria-current="page" >Home</a></li>
                <li><a href="" class="nav-link px-2 text-white">Personnel</a></li>
                <li><a href="" class="nav-link px-2 text-white">Pointage</a></li>
                <li><a href="" class="nav-link px-2 text-white">Paiment</a></li>

            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control form-control-dark text-white bg-dark" placeholder="Search..." aria-label="Search">
            </form>

            <div class="text-end d-flex align-items-center">
                <div>
                    <a type="button" href="" class="btn btn-outline-primary">Se connecter</a>
                </div>

                @auth
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-outline-light ms-2">Déconnexion</button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</header>
</body>
</html>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success">
                Détails du Personnel
            </div>
            <div class="card-body">
                <p><strong>Nom:</strong> {{ $personnel->nom }}</p>
                <p><strong>Prénom:</strong> {{ $personnel->prenom }}</p>
                <p><strong>Téléphone:</strong> {{ $personnel->telephone }}</p>
                <p><strong>Carte d'identité:</strong> {{ $personnel->carte_identite }}</p>
                <p><strong>Horaires de travail:</strong> {{ $personnel->horaires_travail }}</p>
                <p><strong>Email:</strong> {{ $personnel->email }}</p>
                <p><strong>CJM:</strong> {{ $personnel->cjm }}</p>
            </div>
        </div>
    </div>

