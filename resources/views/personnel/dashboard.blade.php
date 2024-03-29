@extends('navbar')

@section('content')
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

        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            overflow: hidden;
            background-color: #fff;
        }

        .card-header {
            background-color: #6c757d;
            color: #fff;
            padding: 10px 15px;
            font-size: 20px;
        }

        .card-body {
            padding: 15px;
        }

        .card-body .card {
            margin-bottom: 20px;
        }

        .card-body .card.bg-primary {
            background-color: #007bff;
            color: #fff;
        }

        .card-body .card.bg-success {
            background-color: #28a745;
            color: #fff;
        }

        .card-body .card.bg-warning {
            background-color: #ffc107;
            color: #212529;
        }
    </style>


    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Tableau de bord
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-body bg-primary">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="mb-0">{{ $totalEmployees }}</h3>
                                    <span class="text-uppercase font-size-xs">Total Employés</span>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <i class="icon-users4 icon-3x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-body bg-success">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="mb-0">{{ $totalPointages }}</h3>
                                    <span class="text-uppercase font-size-xs">Total Pointages</span>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <i class="icon-watch2 icon-3x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-body bg-warning">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="mb-0">{{ $totalPaiements }}</h3>
                                    <span class="text-uppercase font-size-xs">Total Paiements</span>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <i class="icon-coins icon-3x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection
