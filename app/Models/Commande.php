<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'client_id',
        'status', // Le statut de la commande (ex: en attente, expédiée, etc.)
        'montant',
        'date_paiement',
    ];
    public function elements()
    {
        return $this->hasMany(CommandeElement::class, 'commande_id');
    }

    public function livres()
    {
        return $this->hasManyThrough(Livre::class, CommandeElement::class, 'commande_id', 'id', 'id', 'livre_id');
    }



    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    // ✅ Relation avec les paiements
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    // Commande.php

    public function produits()
    {
        return $this->belongsToMany(Livre::class, 'commande_livre', 'commande_id', 'livre_id');
    }

}
