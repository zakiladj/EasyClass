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
        Schema::create('paiement_abonements', function (Blueprint $table) {
            $table->id();

            // relation vers l'abonement_enfant
            $table->foreignId('abonement_enfant_id')
                  ->constrained('abonnement_enfants')
                  ->onDelete('cascade');

            // informations du paiement
            $table->date('date_paiement')->nullable();
            $table->decimal('montant_paye', 10, 2);
            $table->enum('mode_paiement', ['espèce', 'chèque', 'virement', 'autre'])->default('espèce');
            $table->string('reference')->nullable(); // numéro de reçu ou de transaction
            $table->text('remarque')->nullable(); // commentaires ou notes
            $table->boolean('etat')->default(true); // true = paiement validé, false = annulé

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_abonements');
    }
};
