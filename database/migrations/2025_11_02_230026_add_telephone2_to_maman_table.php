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
        Schema::table('mamen', function (Blueprint $table) {
            $table->string('numero2')->nullable()->after('numero1');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mamen', function (Blueprint $table) {
            $table->dropColumn('numero2');
        });
    }
};
