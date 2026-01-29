<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employee_controls', function (Blueprint $table) {
            $table->id();

            // الموظف
            $table->foreignId('employe_id')
                ->constrained('employes')
                ->cascadeOnDelete();

            // شهر وسنة الرواتب
            $table->unsignedTinyInteger('month'); // 1..12
            $table->unsignedSmallInteger('year'); // 2025...


            // الراتب الإجمالي لهذا الشهر (نسخة من salaire في employees)
            $table->decimal('salary_total', 12, 2)->default(0);

            // مجموع ما تم دفعه
            $table->decimal('paid_total', 12, 2)->default(0);

            // الباقي
            $table->decimal('rest', 12, 2)->default(0);
            $table->decimal('advance_total', 12, 2)->default(0);
            $table->decimal('bonus_total', 12, 2)->default(0);
             $table->decimal('deductions_total', 12, 2)->default(0);

            // الحالة: 1 يظهر في القائمة (غير مكتمل) / 0 مكتمل
            $table->boolean('etat')->default(true);

            // ملاحظة اختيارية
            $table->string('note', 255)->nullable();

            // تتبع من أنشأ/حدّث
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            // ✅ يمنع تكرار نفس الموظف في نفس الشهر/السنة
            $table->unique(['employe_id', 'month', 'year'], 'emp_month_year_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_controls');
    }
};

