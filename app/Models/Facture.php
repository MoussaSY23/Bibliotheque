<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
