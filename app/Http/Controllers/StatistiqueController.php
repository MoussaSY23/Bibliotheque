<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeElement;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistiqueController extends Controller
{
    public function index()
    {
        $aujourdHui = Carbon::today();

        // 📦 1. Commandes en cours aujourd'hui (non payées)
        $commandesEnCours = Commande::whereDate('created_at', $aujourdHui)
            ->where('statut', '!=', 'payee')
            ->get();

        // ✅ 2. Commandes payées aujourd'hui
        $commandesPayees = Commande::whereDate('created_at', $aujourdHui)
            ->where('statut', 'payee')
            ->get();

        // 💸 3. Recettes du jour (total des paiements du jour)
        $recettes = Paiement::whereDate('created_at', $aujourdHui)->sum('montant');

        // 📊 4. Commandes par mois (pour un graphique)
        $commandesParMois = Commande::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total')
            ->toArray();

        $moisLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];

        // 📚 5. Livres les plus vendus ce mois (par titre)
        $livresVendus = CommandeElement::join('livres', 'commande_elements.livre_id', '=', 'livres.id')
            ->join('commandes', 'commande_elements.commande_id', '=', 'commandes.id')
            ->select('livres.titre', DB::raw('SUM(commande_elements.quantite) as total_vendus'))
            ->whereMonth('commandes.created_at', now()->month)
            ->groupBy('livres.titre')
            ->orderByDesc('total_vendus')
            ->limit(5) // top 5
            ->get();

        // On extrait les titres et les quantités pour un graphique
        $titres = $livresVendus->pluck('titre');
        $quantites = $livresVendus->pluck('total_vendus');

        return view('statistiques.index', compact(
            'commandesEnCours',
            'commandesPayees',
            'recettes',
            'commandesParMois',
            'moisLabels',
            'titres',
            'quantites'
        ));
    }
}
