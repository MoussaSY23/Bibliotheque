@extends('layouts.app')

@section('content')
    <h1>Modifier le client : {{ $client->nom }}</h1>

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Indique que c'est une mise à jour -->
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $client->prenom) }}" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $client->nom) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $client->telephone) }}" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $client->adresse) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le client</button>
    </form>
@endsection
<!-- resources/views/clients/edit.blade.php -->
