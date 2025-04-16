@extends('layouts.app')

@section('content')
    <h1>Liste des Paiements</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Commande</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ $paiement->commande->id }}</td>
                    <td>{{ $paiement->montant }}</td>
                    <td>{{ $paiement->statut }}</td>
                    <td>
                        <a href="{{ route('paiements.show', $paiement->id) }}" class="btn btn-info">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
