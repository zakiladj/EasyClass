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
        Schema::table('abonnement_enfants', function (Blueprint $table) {
            $table->decimal('frais_inscription', 10, 2)->nullable()->after('montant');
            $table->decimal('frais_livres', 10, 2)->nullable()->after('frais_inscription');
            $table->decimal('remise', 10, 2)->nullable()->after('frais_livres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abonnement_enfants', function (Blueprint $table) {

            $table->dropColumn(['frais_inscription', 'frais_livres', 'remise']);
        });
    }
};
