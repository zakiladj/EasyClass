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
        Schema::create('abonnement_enfants', function (Blueprint $table) {
            $table->id();

            // relations
            $table->foreignId('enfant_id')->constrained('enfants')->onDelete('cascade');
            $table->foreignId('abonement_id')->constrained('abonnements')->onDelete('cascade');

            // informations supplémentaires
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->decimal('montant', 10, 2)->nullable(); // montant de l’abonnement
            $table->boolean('etat')->default(true); // actif ou non

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnement_enfants');
    }
};
