@extends('layouts.app')

@section('content')
    <!-- Ajouter SweetAlert2 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="fw-bold text-primary">Détails de la commande #{{ $commande->id }}</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Retour à la liste des commandes</a>
            </div>
        </div>

        <div class="card shadow-sm rounded-4 mb-4">
            <div class="card-body">
                <h4><strong>Client:</strong> {{ App\Models\User::find($commande->utilisateur_id)->prenom }} {{ App\Models\User::find($commande->utilisateur_id)->nom }}</h4>
                <p><strong>Statut de la commande:</strong> <span class="badge bg-info">{{ ucfirst($commande->statut) }}</span></p>
                <p><strong>Date de création:</strong> {{ $commande->created_at->format('d M Y, H:i') }}</p>
                <p><strong>Montant total:</strong> <span class="h5 text-success">{{ number_format($commande->montant_total, 2, ',', ' ') }}€</span></p>
                @if(\Illuminate\Support\Facades\Auth::user()->role === 'gestionnaire')
                <!-- Formulaire de mise à jour du statut -->
                <form action="{{ route('commandes.updateStatut', $commande->id) }}" method="POST">
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
                            <button type="submit" class="btn btn-primary ml-2">Confirmer</button>
                        </div>
                    </div>
                </form>

                <!-- Formulaire de paiement -->
                @if($commande->statut != 'payee')
                    <form action="{{ route('paiements.store', $commande->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$commande->id}}" name="commande_id">
                        <div class="form-group">
                            <label for="methode_paiement" class="fw-bold">Méthode de Paiement:</label>
                            <input type="text" name="methode_paiement" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="montant" class="fw-bold">Montant du Paiement:</label>
                            <input type="number" name="montant" class="form-control" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-success">Enregistrer le Paiement</button>
                    </form>
                    @endif
                @else
                    <p><span class="badge bg-success">Cette commande est déjà payée.</span></p>
                @endif
            </div>
        </div>

        <h3 class="fw-bold mb-4">Livres Commandés</h3>
        <div class="row">
            @foreach($commande->elements as $element)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $element->livre->image) }}" class="img-fluid rounded-3 mb-2" alt="{{ $element->livre->titre }}" style="max-width: 120px; height: 180px; object-fit: cover;">
                            <h5 class="card-title">{{ $element->livre->titre }}</h5>
                            <p class="text-muted">{{ $element->livre->auteur }}</p>
                            <p class="fw-bold">Quantité: {{ $element->quantite }}</p>
                            <p><strong>Prix unitaire:</strong> {{ $element->prix }}€</p>
                            <p><strong>Total:</strong> <span class="text-success">{{ number_format($element->prix * $element->quantite, 2, ',', ' ') }}€</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Actions supplémentaires -->
        @if(Auth::user()->role == 'client')
            @if($commande->statut == 'en_attente')
            <div class="d-flex justify-content-between mt-5">
                <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning">Modifier la commande</a>
                <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" id="delete-form-{{ $commande->id }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, {{ $commande->id }})">
                    Annuler la commande
                </button>
            </div>
            @endif
        @endif

        @if(Auth::user()->role == 'gestionnaire')
                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning">Modifier la commande</a>
                    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" id="delete-form-{{ $commande->id }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, {{ $commande->id }})">
                        Annuler la commande
                    </button>
                </div>
            @endif

    </div>

    <!-- Affichage des messages de succès ou d'erreur avec SweetAlert2 -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: "{{ session('success') }}",
                confirmButtonColor: '#28a745',
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33',
            });
        </script>
    @endif

    <!-- Script pour la confirmation de suppression -->
    <script>
        function confirmDeletion(event, id) {
            event.preventDefault(); // Empêche la redirection immédiate

            Swal.fire({
                title: "Êtes-vous sûr de vouloir supprimer cette commande ?",
                text: "Cette action est irréversible !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, supprimer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
