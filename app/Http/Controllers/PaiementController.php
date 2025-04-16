<?php

namespace App\Http\Controllers;

use App\Mail\FactureMail;
use App\Mail\PaiementConfirmationMail;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Livre;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaiementController extends Controller
{
    // Afficher la liste des paiements
    public function index()
    {
        $paiements = Paiement::all();
        return view('paiements.index', compact('paiements'));
    }

    // Afficher le formulaire pour créer un paiement
    public function create()
    {

        $commandes = Commande::all(); // Récupérer toutes les commandes
        return view('paiements.create', compact('commandes')); // Passer les commandes à la vue
    }

    public function store(Request $request)
    {
        $commande = Commande::find($request->commande_id);

        $paiement = new Paiement();
        $paiement->commande_id = $request->commande_id;
        $paiement->montant = $request->montant;
        $paiement->methode_paiement = $request->methode_paiement; // exemple de statut
        $commande->statut = 'expedie';
        // Envoi de l'email avec la facture
        Mail::to($commande->client->email)
            ->send(new FactureMail($commande, $paiement));

            // Enregistrer le paiement dans la base de données

            $paiement->save();

            // Récupérer la commande


            // Redirection avec message de succès
            return redirect()->route('commandes.show', $commande->id)->with('success', 'Le paiement a été effectué et la facture envoyée par email.');

    }



    // Afficher les détails d'un paiement spécifique
    public function show($id)
    {
        $paiement = Paiement::findOrFail($id);
        return view('paiements.show', compact('paiement'));
    }

    // Afficher le formulaire pour modifier un paiement
// CommandeController.php

    // CommandeController.php
    public function edit($id)
    {
        $commande = Commande::with('livres')->findOrFail($id); // Charger les livres liés
        $livres = Livre::all(); // Récupérer tous les livres
        $clients = Client::all();
        return view('commandes.edit', compact('commande', 'livres', 'clients'));
    }


// Méthode pour enregistrer un paiement
    public function storePayment(Request $request, $commandeId)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'methode_paiement' => 'required|string',
        ]);

        $commande = Commande::findOrFail($commandeId);

        // Créer un paiement pour la commande
        $paiement = new Paiement();
        $paiement->commande_id = $commandeId;
        $paiement->montant = $request->montant;
        $paiement->methode_paiement = $request->methode_paiement;
        $paiement->save();

        // Envoi du paiement par e-mail au client
        Mail::to($commande->client->email)->send(new PaiementConfirmationMail($paiement));

        return redirect()->route('commandes.edit', $commandeId)->with('success', 'Paiement ajouté et confirmation envoyée par e-mail.');
    }





    // Mettre à jour un paiement
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'montant' => 'required|numeric',
            'mode' => 'required|string',
            'commande_id' => 'required|exists:commandes,id',
        ]);

        // Récupérer le paiement existant
        $paiement = Paiement::findOrFail($id);
        $paiement->montant = $request->montant;
        $paiement->mode = $request->mode;
        $paiement->commande_id = $request->commande_id;

        // Mettre à jour le paiement dans la base de données
        $paiement->save();

        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour avec succès!');
    }

    // Supprimer un paiement
    public function destroy($id)
    {
        // Récupérer et supprimer le paiement
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès!');
    }
}
