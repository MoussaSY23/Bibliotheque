@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="fw-bold text-primary">Modifier la commande #{{ $commande->id }}</h1>

        <div class="card shadow-sm rounded-4 mb-4">
            <div class="card-body">
                <h4><strong>Client:</strong> {{ $commande->utilisateur->prenom }} {{ $commande->utilisateur->nom }}</h4>
                <p><strong>Email:</strong> {{ $commande->utilisateur->email }}</p>
                <p><strong>Date de la commande:</strong> {{ $commande->created_at->format('d M Y, H:i') }}</p>
                <p><strong>Montant total:</strong> <span class="h5 text-success">{{ number_format($commande->montant_total, 2, ',', ' ') }}€</span></p>

                <!-- Formulaire pour modifier le statut -->
                <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="statut" class="fw-bold">Modifier le statut :</label>
                        <div class="input-group mb-3">
                            <select name="statut" id="statut" class="form-control">
                                <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                                <option value="en_preparation" {{ $commande->statut == 'en_preparation' ? 'selected' : '' }}>En Préparation</option>
                                <option value="expediee" {{ $commande->statut == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                                <option value="payee" {{ $commande->statut == 'payee' ? 'selected' : '' }}>Payée</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Affichage des paiements -->
        <h3 class="fw-bold mt-4">Paiements effectués</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Montant</th>
                <th>Méthode de paiement</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commande->paiement as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ number_format($paiement->montant, 2, ',', ' ') }}€</td>
                    <td>{{ ucfirst($paiement->methode_paiement) }}</td>
                    <td>{{ $paiement->created_at->format('d M Y, H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Bouton pour générer la facture -->
        <a href="{{ route('commandes.facture', $commande->id) }}" class="btn btn-success mt-3">Générer la Facture</a>

    </div>
@endsection
