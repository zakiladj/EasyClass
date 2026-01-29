<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employes', function (Blueprint $table) {

            $table->enum('statut', ['Actif', 'Inactif'])->default('Actif')->after('salaire');

        });
        DB::table('employes')->update(['statut' => 'Actif']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employes', function (Blueprint $table) {

            $table->dropColumn('statut');
        });
    }
};
