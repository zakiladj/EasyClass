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
        Schema::create('fee_amounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fee_category_id');
            $table->unsignedBigInteger('student_class_id');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('active');
            $table->foreign('fee_category_id')->references('id')->on('student_fees')->onDelete('cascade');
            $table->foreign('student_class_id')->references('id')->on('student_classes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_amounts');
    }
};

