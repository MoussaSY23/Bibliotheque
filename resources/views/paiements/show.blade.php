@extends('layouts.app')

@section('content')
    <h1>Détails du Paiement</h1>
    <p>ID du paiement: {{ $paiement->id }}</p>
    <p>Commande: {{ $paiement->commande->id }}</p>
    <p>Montant: {{ $paiement->montant }}</p>
    <p>Statut: {{ $paiement->statut }}</p>
@endsection
