@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la commande</h1>

        <!-- Informations de la commande et du client -->
        <div class="card">
            <div class="card-header">
                <h4>Commande #{{ $commande->id }} - Client: {{ $commande->client->name }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Client:</strong> {{ $commande->client->name }}</p>
                <p><strong>Email:</strong> {{ $commande->client->email }}</p>
                <p><strong>Statut de la commande:</strong> {{ $commande->statut }}</p>
                <p><strong>Total de la commande:</strong> {{ $commande->livres->sum('prix') }}€</p>

                <!-- Liste des livres associés à la commande -->
                <ul>
                    @foreach($commande->livres as $livre)
                        <li>{{ $livre->titre }} - {{ $livre->prix }}€</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Formulaire de paiement -->
        <h3>Ajouter un paiement</h3>
        <form action="{{ route('paiements.store', $commande->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="montant">Montant</label>
                <input type="number" name="montant" id="montant" class="form-control" required step="0.01" min="0">
            </div>

            <div class="form-group">
                <label for="methode_paiement">Méthode de paiement</label>
                <select name="methode_paiement" id="methode_paiement" class="form-control" required>
                    <option value="especes">Espèces</option>
                    <option value="carte">Carte bancaire</option>
                    <option value="virement">Virement</option>
                    <!-- Ajouter d'autres méthodes de paiement selon tes besoins -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter le paiement</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
