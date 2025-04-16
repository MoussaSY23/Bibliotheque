<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation de commande</title>
</head>
<body>
<h1>Merci pour votre commande !</h1>
<p>Bonjour {{ $commande->client->nom }},</p>
<p>Votre commande n° {{ $commande->id }} a bien été enregistrée.</p>
<p>Montant total : <strong>{{ number_format($commande->montant_total, 2) }} €</strong></p>
<p>Statut : {{ $commande->statut }}</p>

<h3>Détails de la commande :</h3>
<ul>
    @foreach($commande->elements as $element)
        <li>
            Livre : {{ $element->livre->titre }} - Quantité : {{ $element->quantite }} - Prix : {{ number_format($element->prix, 2) }} €
        </li>
    @endforeach
</ul>

<p>Nous vous remercions de votre confiance.</p>
</body>
</html>
