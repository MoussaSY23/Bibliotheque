<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // clé étrangère vers client
            $table->decimal('montant', 8, 2); // montant de la facture
            $table->enum('statut', ['en attente', 'payée', 'annulée']); // statut de la facture
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade'); // relation avec la table users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
