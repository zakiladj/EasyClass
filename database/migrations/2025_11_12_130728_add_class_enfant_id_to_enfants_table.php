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
        Schema::table('enfants', function (Blueprint $table) {

            $table->unsignedBigInteger('class_enfant_id')->after('id'); // إضافة العمود بعد العمود id
            $table->foreign('class_enfant_id')
            ->references('id')
            ->on('class_enfants')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enfants', function (Blueprint $table) {
            //
        });
    }
};
