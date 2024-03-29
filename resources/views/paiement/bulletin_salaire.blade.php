<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture de paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Facture de paiement</h1>
    <div class="invoice-details">
        <p>Date du paiement : {{ $paiement->date_paiement }}</p>
        <p>Montant : {{ $paiement->montant }}</p>
        <p>Nom du personnel : {{ $paiement->personnel->nom }} {{ $paiement->personnel->prenom }}</p>
        <p>Email : {{ $paiement->personnel->email }}</p>
        <p>Horaire : {{ $paiement->personnel->horaires_travail }}</p>
        <p>CJM : {{ $paiement->personnel->cjm * $paiement->personnel->horaires_travail}}</p>
    </div>
    <table>
        <thead>
        <tr>
            <th>Description</th>
            <th>Montant</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Montant total</td>
            <td>{{ $paiement->montant }}</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
