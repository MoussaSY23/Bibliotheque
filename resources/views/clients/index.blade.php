@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Bouton Ajouter -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-primary">Liste des Clients</h1>
            <a href="{{ route('clients.create') }}" class="btn btn-success">
                <i class="bi bi-person-plus"></i> Ajouter un Client
            </a>
        </div>

        <!-- Tableau des clients -->
        <div class="card shadow-lg rounded-4">
            <div class="card-body">
                <table class="table table-striped table-hover text-center">
                    <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $index => $client)
                        <tr>
                            <td><strong>{{ $index + 1 }}</strong></td>
                            <td>{{ $client->nom }}</td>
                            <td>{{ $client->prenom }}</td>
                            <td>{{ $client->telephone }}</td>
                            <td>{{ $client->adresse }}</td>
                            <td>{{ $client->email }}</td>
                            <td>
                                <div class="btn-group">
                                    <!-- Modifier -->

                                    <!-- Supprimer -->
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
