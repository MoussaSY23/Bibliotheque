@extends('layouts.app')

@section('content')


    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter le client</button>
    </form>
@endsection
