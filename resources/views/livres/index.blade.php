@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">📚 Liste des Livres</h1>
            <a href="{{ route('livres.create') }}" class="btn btn-success">➕ Ajouter un livre</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($livres as $livre)
                <div class="col">
                    <div class="card h-100 shadow-lg border-0 rounded-4">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $livre->image) }}" class="card-img-top rounded-top-4" alt="{{ $livre->titre }}" style="height: 250px; object-fit: cover;">
                            @if($livre->stock < 5)
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">Stock Faible</span>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $livre->titre }}</h5>
                            <p class="card-text text-muted mb-2">✍️ <strong>Auteur:</strong> {{ $livre->auteur }}</p>
                            <p class="card-text text-success fs-5 fw-bold">💰 {{ $livre->prix }} €</p>
                            <p class="card-text text-secondary">📦 <strong>Stock:</strong> {{ $livre->stock }} en stock</p>
                        </div>
                        <div class="card-footer bg-light d-flex justify-content-between align-items-center border-0 rounded-bottom-4">
                            <a href="{{ route('livres.show', $livre) }}" class="btn btn-primary">👁 Voir</a>

                            @if(\Illuminate\Support\Facades\Auth::user()->role != 'client')
                            <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">✏️ Modifier</a>
                            <form action="{{ route('livres.destroy', $livre) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑 Supprimer</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
