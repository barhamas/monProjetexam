<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Styles for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-success {
            background-color: #28a745;
        }

        /* Styles for the image */
        .stretch-image {
            width: 100%;
            object-fit: cover;
            height: auto;
        }
    </style>
</head>
<body>
@extends('navbar')

@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="{{ asset('storage/ph.jpeg') }}" class="img-fluid stretch-image" alt="Illustration of a mobile phone">
                </div>

                <div class="col-md-4 col-lg-5 col-xl-6">
                    <h1>Bienvenue sur le site</h1>
                    <p>Voulez-vous vous connecter en tant qu'administrateur ou pointer ?</p>

                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('administrateurs.create') }}" class="btn btn-success w-50">Administrateur</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
</body>
</html>
