<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header img {
            height: 50px;
        }
        .header .title {
            font-size: 32px;
            font-weight: 700;
            color: #2b2d42;
        }
        .header .info {
            text-align: right;
            font-size: 16px;
            color: #888;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-details p {
            font-size: 16px;
            margin: 8px 0;
        }
        .invoice-details strong {
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 12px;
            text-align: left;
        }
        .table th {
            background-color: #f5f5f5;
            color: #333;
        }
        .table td {
            background-color: #fafafa;
        }
        .table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: 700;
        }
        .total span {
            color: #2ecc71;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }
        .footer a {
            color: #3498db;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- En-tête -->
    <div class="header">
        <img src="https://via.placeholder.com/150x50.png?text=Logo" alt="Logo de l'entreprise">
        <div class="title">Facture #{{ $commande->id }}</div>
    </div>

    <!-- Détails de la commande -->
    <div class="invoice-details">
        <p><strong>Client:</strong> {{ App\Models\User::find($commande->utilisateur_id)->prenom }} {{ App\Models\User::find($commande->utilisateur_id)->nom }}</p>
        <p><strong>Statut de la commande:</strong> {{ ucfirst($commande->statut) }}</p>
        <p><strong>Date de création:</strong> {{ $commande->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Montant total:</strong> <span>{{ number_format($commande->montant_total, 2, ',', ' ') }}€</span></p>
    </div>

    <!-- Tableau des livres commandés -->
    <h3>Livres Commandés</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commande->elements as $element)
            <tr>
                <td>{{ $element->livre->titre }}</td>
                <td>{{ $element->livre->auteur }}</td>
                <td>{{ $element->quantite }}</td>
                <td>{{ number_format($element->prix, 2, ',', ' ') }}€</td>
                <td>{{ number_format($element->prix * $element->quantite, 2, ',', ' ') }}€</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        <p><strong>Total à Payer: <span>{{ number_format($commande->montant_total, 2, ',', ' ') }}€</span></strong></p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Merci pour votre achat !</p>
        <p>Si vous avez des questions, contactez-nous à <a href="mailto:contact@exemple.com">contact@exemple.com</a></p>
        <p>Site Web: <a href="https://www.exemple.com">www.exemple.com</a></p>
    </div>
</div>
</body>
</html>
