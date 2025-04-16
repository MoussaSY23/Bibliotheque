@extends('layouts.app')

@section('content')
    <h1>Détails du Client</h1>
    <p>ID du client: {{ $client->id }}</p>
    <p>Nom: {{ $client->nom }}</p>
    <p>Prénom: {{ $client->prenom }}</p>
    <p>Téléphone: {{ $client->telephone }}</p>
    <p>Adresse: {{ $client->adresse }}</p>
    <p>Email: {{ $client->email }}</p>
    <p>Commandes du Client :</p>
    <ul>
        @foreach($client->commandes as $commande)
            <li>Commande #{{ $commande->id }} - Statut: {{ $commande->statut }}</li>
        @endforeach
    </ul>
@endsection
