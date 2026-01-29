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
        Schema::create('employee_payments', function (Blueprint $table) {

            $table->foreignId('employee_control_id')
                ->constrained('employee_controls')
                ->cascadeOnDelete();

            // الربط مع الموظف (اختياري لكنه مفيد للبحث والتقارير)
            $table->foreignId('employe_id')
                ->constrained('employes')
                ->cascadeOnDelete();
            $table->enum('type_action', ['Advance', 'Salaire', 'Bonus', 'Deductions']);
            $table->decimal('amount', 12, 2);
            $table->date('payment_date')->nullable();
            $table->string('note', 255)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->index(['employe_id', 'payment_date']);
            $table->index(['employee_control_id', 'type_action']);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_payments');
    }
};
