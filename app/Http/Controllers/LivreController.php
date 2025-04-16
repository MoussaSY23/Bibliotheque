<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::all();
        return view('livres.index', compact('livres'));
    }

    public function create()
    {
        return view('livres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'auteur' => 'required',
            'prix' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $livre = Livre::create($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/livres', 'public');
            $livre->image = $imagePath;
            $livre->save();
        }

        return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès!');
    }

    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    public function edit(Livre $livre)
    {
        return view('livres.edit', compact('livre'));
    }

    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'titre' => 'required',
            'auteur' => 'required',
            'prix' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $livre->update($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/livres', 'public');
            $livre->image = $imagePath;
            $livre->save();
        }

        return redirect()->route('livres.index')->with('success', 'Livre mis à jour avec succès!');
    }

    public function destroy(Livre $livre)
    {
        $livre->delete();
        return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès!');
    }
}
//         $commande->produits()->detach(); // Détacher tous les produits existants
//         foreach ($request->produit_id as $produitId) {
//             $commande->produits()->attach($produitId, ['quantite' => 1, 'prix' => Livre::find($produitId)->prix]);
//         }
//
//         return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès!');
//     }
//     }
//         return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès!');
//     }
//     }
//     }
//         return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès!');
//     }