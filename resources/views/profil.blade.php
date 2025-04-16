@extends('layouts.app')

@section('content')
    <style>
        .user-info {
            margin-top: 40px; /* Plus d'espace au-dessus */
            padding: 30px; /* Plus de padding interne */
            background-color: #f8f9fa; /* Couleur de fond plus claire */
            border-radius: 10px; /* Bordures plus arrondies */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Ombre plus marquée */
        }

        .info-text {
            font-size: 1.4rem; /* Taille de police plus grande */
            line-height: 1.6; /* Espacement entre les lignes */
        }

        .info-text strong {
            font-weight: bold; /* Mettre en gras les labels */
            font-size: 1.6rem; /* Taille de police plus grande pour les labels */
        }
    </style>

    <div class="features">
        <h1>Bienvenue, {{ Auth::user()->prenom }}!</h1>

        <div class="user-info">
            <div class="info-text">
                <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
                <p><strong>Prénom :</strong> {{ Auth::user()->prenom }}</p>
                <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
                <p><strong>role :</strong> {{ Auth::user()->role }}</p>
                <p><strong>adresse :</strong> {{ Auth::user()->adresse }}</p>
                <p><strong>telephone :</strong> {{ Auth::user()->telephone }}</p>
            </div>
        </div>

        <a href="{{ route('clients.edit', Auth::user()->id) }}" class="btn btn-primary mt-3">Modifier Profil</a>
    </div>
@endsection
