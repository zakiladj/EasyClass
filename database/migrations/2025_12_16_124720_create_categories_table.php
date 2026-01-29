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
        Schema::create('categories', function (Blueprint $table) {

            $table->id();

            // اسم التصنيف (مثال: اشتراك أطفال، كراء، رواتب)
            $table->string('name');

            // نوع التصنيف: دخل أو مصروف
            $table->enum('type', ['revenu', 'charges']);

            // ملاحظات / شرح إضافي
            $table->text('note')->nullable();

            // هل التصنيف نشط أم لا
            $table->boolean('is_active')->default(true);

            // تتبع المستخدم
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();

            // منع تكرار نفس الاسم لنفس النوع
            $table->unique(['name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
