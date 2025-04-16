<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'commande_id',
        'montant',
        'date_paiement',
        'methode_paiement',
    ];

    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
