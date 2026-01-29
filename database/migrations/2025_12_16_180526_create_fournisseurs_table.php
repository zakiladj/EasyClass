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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_commercial');
            $table->string('raison_sociale')->nullable();
            $table->enum('type', ['personne', 'entreprise'])->default('entreprise');
            $table->string('telephone')->nullable();
            $table->string('telephone_secondaire')->nullable();
            $table->string('email')->nullable();
            $table->string('site_web')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('banque')->nullable();
            $table->string('rib')->nullable();
            $table->string('baridimob')->nullable();
            $table->string('categorie')->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            // 🕒 Timestamps

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
