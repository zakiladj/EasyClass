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
        Schema::create('child_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pere_id')
                  ->constrained('peres')
                  ->cascadeOnDelete();
            $table->foreignId('abonnement_enfant_id')
                  ->constrained('abonnement_enfants')
                  ->cascadeOnDelete();
            $table->decimal('total', 10, 2);
            $table->decimal('payee', 10, 2);
            $table->decimal('rest_pay', 10, 2);
            $table->dateTime('date_paiement');
            $table->text('note')->nullable();
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_payments');
    }
};
