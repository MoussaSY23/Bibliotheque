<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::all();
        return view('factures.index', compact('factures'));
    }

    public function create()
    {
        return view('factures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'montant' => 'required|numeric',
        ]);

        Facture::create($request->all());

        return redirect()->route('factures.index')->with('success', 'Facture créée avec succès');
    }

}
