<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ecritures_comptables', function (Blueprint $table) {
            $table->id();

            // نوع القيد: دخل أو مصروف
            $table->enum('type', ['revenu', 'charges']);

            // التصنيف المالي (اشتراك، رواتب، كراء...)
            $table->foreignId('categorie_id')
                ->constrained('categories')
                ->restrictOnDelete();

            // المبلغ (دائمًا موجب)
            $table->decimal('amount', 10, 2);

            // تاريخ العملية المالي الحقيقي (مهم للتقارير)
            $table->dateTime('entry_date')->index();

            // ربط القيد بمصدره (دفعة طفل / مصروف / راتب...)
            // Polymorphic
            $table->string('source_type')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->index(['source_type', 'source_id']);

            // ملاحظات
            $table->text('notes')->nullable();

            // من أنشأ/عدّل القيد
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

    public function down(): void
    {
        Schema::dropIfExists('ecritures_comptables');
    }
};
