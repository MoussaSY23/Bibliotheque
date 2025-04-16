<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'adresse',
        'telephone',
    ];

    // Relation avec les commandes (un client peut avoir plusieurs commandes)
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }



}
