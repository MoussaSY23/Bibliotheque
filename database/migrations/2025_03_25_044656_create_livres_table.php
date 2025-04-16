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
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Titre du livre
            $table->string('auteur'); // Auteur du livre
            $table->decimal('prix', 8, 2); // Prix du livre
            $table->text('description'); // Description du livre
            $table->string('image')->nullable(); // Image du livre
            $table->integer('stock'); // Stock disponible
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
