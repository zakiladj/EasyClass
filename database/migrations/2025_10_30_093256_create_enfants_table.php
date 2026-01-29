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
        Schema::create('enfants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->enum('sexe', ['M', 'F']);
            $table->string('adresse')->nullable();
            $table->unsignedBigInteger('pere_id')->nullable();
            $table->unsignedBigInteger('maman_id')->nullable();
            $table->text('allergies')->nullable();
            $table->text('infos_medicales')->nullable();
            $table->string('document_certificat_medical')->nullable();
            $table->date('date_inscription');
            $table->enum('statut', ['actif', 'inactif', 'archive'])->default('actif');
            $table->timestamps();

            // Relations (clés étrangères)
            $table->foreign('pere_id')->references('id')->on('peres')->onDelete('set null');
            $table->foreign('maman_id')->references('id')->on('mamen')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfants');
    }
};
