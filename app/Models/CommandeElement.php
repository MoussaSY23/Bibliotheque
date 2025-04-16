<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'livre_id',
        'quantite',
        'prix',
    ];

    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    // Relation avec le livre
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }
}
