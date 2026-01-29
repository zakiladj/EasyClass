<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Enfant\AbonnementEnfant;
use Carbon\Carbon;

class CheckAbonnementEnfantValidity extends Command
{
    // اسم الأمر اللي راح تنفذه: php artisan creche:check-abonnements
    protected $signature = 'creche:check-abonnements';

    protected $description = "Check daily abonnement_enfant validity and set etat=0 for expired ones";

    public function handle()
    {
        $today = Carbon::today(); // تاريخ اليوم فقط

        $updated = AbonnementEnfant::query()
            ->where('etat', 1)                  // نشط
            ->whereNotNull('date_fin')          // عنده تاريخ نهاية
            ->whereDate('date_fin', '<', $today) // انتهى قبل اليوم
            ->update([
                'etat' => 0,                    // منتهي
                'updated_at' => now(),
            ]);

        $this->info("Expired abonnements updated: {$updated}");

        return Command::SUCCESS;
    }
}
