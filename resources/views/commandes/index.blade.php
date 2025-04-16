@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Page Heading -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des Commandes</h1>
                    </div>
                    <div class="col-sm-6">
                        @auth
                            @if(Auth::user()->role == 'client')
                                <a href="{{ route('commandes.create') }}" class="btn btn-primary float-right">+ Nouvelle Commande</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Page Content -->
        <section class="content">
            <div class="container-fluid">
                @auth
                    <div class="row">
                        @foreach($commandes->groupBy('utilisateur_id') as $utilisateurId => $userCommandes)
                            @php
                                $client = $userCommandes->first()->client;
                            @endphp

                            @if(Auth::user()->role == 'gestionnaire' || Auth::user()->id == $client->id)
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h4>Commandes de {{ $client->prenom }} {{ $client->nom }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($userCommandes as $commande)
                                                    <div class="col-md-6 col-lg-4 mb-4">
                                                        <div class="card shadow-sm">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Commande #{{ $commande->id }}</h5>
                                                                <p><strong>Client:</strong> {{ $commande->client->prenom }} {{ $commande->client->nom }}</p>
                                                                <p>
                                                                    <strong>Statut:</strong>
                                                                    <span class="badge
                                                @if($commande->statut == 'En cours') bg-warning
                                                @elseif($commande->statut == 'Livrée') bg-success
                                                @else bg-secondary
                                                @endif">
                                                {{ $commande->statut }}
                                            </span>
                                                                </p>
                                                                <div class="d-flex justify-content-end">
                                                                    <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-info btn-sm">Voir Détails</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        Veuillez vous connecter pour consulter vos commandes.
                    </div>
                @endauth
            </div>
        </section>
    </div>
@endsection
