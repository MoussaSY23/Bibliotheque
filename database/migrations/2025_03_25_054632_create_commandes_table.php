<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade'); // Lien vers l'utilisateur (client)
            $table->enum('statut', ['en_attente', 'en_preparation', 'expediee', 'payee']); // Statut de la commande
            $table->decimal('montant_total', 8, 2); // Montant total de la commande
            $table->timestamp('date_paiement')->nullable(); // Date du paiement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
