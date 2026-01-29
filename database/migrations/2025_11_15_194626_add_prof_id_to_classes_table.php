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

            $table->unsignedBigInteger('prof_id')->nullable()->after('id');
            $table->foreign('prof_id')->references('id')->on('employes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {

            $table->dropForeign(['prof_id']);
            $table->dropColumn('prof_id');
        });
    }
};
