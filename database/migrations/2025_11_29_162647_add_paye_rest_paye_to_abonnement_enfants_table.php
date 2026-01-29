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

                    $table->decimal('paye', 8, 2)->nullable();
                    $table->decimal('rest_paye', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abonnement_enfants', function (Blueprint $table) {

            $table->dropColumn('paye');
            $table->dropColumn('rest_paye');
        });
    }
};
