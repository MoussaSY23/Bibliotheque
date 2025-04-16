@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold">Liste des Factures</h1>
        <a href="{{ route('factures.create') }}" class="btn btn-primary mb-3">+ Nouvelle Facture</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($factures as $facture)
                <tr>
                    <td>{{ $facture->id }}</td>
                    <td>{{ App\Models\User::find($facture->client_id)->prenom }}</td>
                    <td>{{ $facture->montant }} €</td>
                    <td>
                            <span class="badge
                                @if($facture->statut == 'payée') bg-success
                                @elseif($facture->statut == 'en attente') bg-warning
                                @else bg-secondary
                                @endif">
                                {{ $facture->statut }}
                            </span>
                    </td>
                    <td>
                        <a href="{{ route('paiements.create', $facture->id) }}" class="btn btn-info btn-sm">Ajouter Paiement</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
