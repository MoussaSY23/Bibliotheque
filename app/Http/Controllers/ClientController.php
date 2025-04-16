<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Afficher la liste de tous les clients
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    // Afficher les détails d'un client spécifique
    public function show($id)
    {
        $client = Client::with('commandes')->findOrFail($id);
        return view('clients.show', compact('client'));
    }

    // Afficher le formulaire de création d'un nouveau client
    public function create()
    {
        return view('clients.create');  // Vue pour ajouter un client
    }

    // Enregistrer un nouveau client
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'required|string|max:15',
            'adresse' => 'required|string|max:255',
        ]);

        // Créer un nouveau client
        Client::create([
            'prenom'=> $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        // Rediriger vers la liste des clients avec un message de succès
        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès!');
    }

    // Afficher le formulaire d'édition d'un client existant
    public function edit($id)
    {
        $client = Client::findOrFail($id);  // Trouver le client à modifier
        return view('clients.edit', compact('client'));  // Retourner la vue d'édition
    }

    // Mettre à jour les informations d'un client
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'telephone' => 'required|string|max:15',
            'adresse' => 'required|string|max:255',
        ]);

        // Récupérer le client à mettre à jour
        $client = Client::findOrFail($id);

        // Mettre à jour les informations du client
        $client->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        // Rediriger vers la liste des clients avec un message de succès
        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès!');
    }

    // Supprimer un client
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();  // Supprimer le client

        // Rediriger vers la liste des clients avec un message de succès
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès!');
    }
}
