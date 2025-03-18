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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->unique();
            $table->decimal('montant', 10, 2);
            $table->enum('mode_paiement', ['especes'])->default('especes');
            $table->dateTime('date_paiement');
            $table->foreignId('utilisateur_id')->constrained('users')->comment('Gestionnaire qui a enregistré le paiement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
