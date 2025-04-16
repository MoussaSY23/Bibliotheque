<h2>Nouvelle commande reçue</h2>
<p>Une nouvelle commande n°{{ $commande->id }} vient d'être passée.</p>
<p>Client : {{ $commande->client->prenom }} {{ $commande->client->nom }}</p>
<p>Montant total : {{ number_format($commande->montant_total, 2, ',', ' ') }} €</p>
