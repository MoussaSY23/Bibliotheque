@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du Livre</h1>
    <p><strong>Titre:</strong> {{ $livre->titre }}</p>
    <p><strong>Auteur:</strong> {{ $livre->auteur }}</p>
    <p><strong>Prix:</strong> {{ $livre->prix }}</p>
    <p><strong>Description:</strong> {{ $livre->description }}</p>
    <p><strong>Stock:</strong> {{ $livre->stock }}</p>
    <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" width="200">
</div>
@endsection
