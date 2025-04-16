<!-- resources/views/emails/paiement_confirmation.blade.php -->

<h1>Confirmation de paiement</h1>
<p>Bonjour {{ $paiement->commande->client->name }},</p>
<p>Nous confirmons que nous avons bien reçu votre paiement de {{ $paiement->montant }}€ pour la commande #{{ $paiement->commande->id }}.</p>
<p>Méthode de paiement : {{ $paiement->methode_paiement }}</p>
<p>Merci pour votre achat !</p>
