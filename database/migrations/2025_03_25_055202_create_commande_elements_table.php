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
        Schema::create('commande_elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade'); // Lien vers la commande
            $table->foreignId('livre_id')->constrained('livres')->onDelete('cascade'); // Lien vers le livre
            $table->integer('quantite'); // Quantité du livre dans la commande
            $table->decimal('prix', 8, 2); // Prix du livre lors de la commande
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_elements');
    }
};
