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
        Schema::table('class_enfants', function (Blueprint $table) {

            $table->integer('place_disponible')->after('capacite')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_enfants', function (Blueprint $table) {
            //
            $table->dropColumn('place_disponible');
        });
    }
};
