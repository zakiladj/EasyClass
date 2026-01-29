<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'enfants',
        'peres',
        'mamen',
        'class_enfants',
        'abonnements',
        'abonnement_enfants',
        'employes',
        'class_enfants',

    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                // إذا الأعمدة ما كانتش موجودة
                if (!Schema::hasColumn($table->getTable(), 'created_by')) {
                    $table->foreignId('created_by')
                        ->nullable()
                        ->constrained('users')
                        ->nullOnDelete();
                }

                if (!Schema::hasColumn($table->getTable(), 'updated_by')) {
                    $table->foreignId('updated_by')
                        ->nullable()
                        ->constrained('users')
                        ->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                // نحاول نحذفهم بطريقة آمنة
                if (Schema::hasColumn($table->getTable(), 'created_by')) {
                    $table->dropConstrainedForeignId('created_by');
                }
                if (Schema::hasColumn($table->getTable(), 'updated_by')) {
                    $table->dropConstrainedForeignId('updated_by');
                }
            });
        }
    }
};

