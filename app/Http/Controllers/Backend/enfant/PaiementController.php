<?php

namespace App\Http\Controllers\Backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Enfant\EmployeeControl;
use App\Models\Enfant\EmployeePayment;
use App\Models\Enfant\EcritureComptable;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PaiementController extends Controller
{

    public function PaiementView($year = null, $month = null){
            if (!$year || !$month) {
                $last = EmployeeControl::orderBy('year','desc')
                    ->orderBy('month','desc')
                    ->first();

                if ($last) {
                    $year  = $last->year;
                    $month = $last->month;
                } else {
                    $year  = (int) date('Y');
                    $month = (int) date('n');
                }
            }
        $controls = EmployeeControl::where('etat', 1)
            ->orderBy('year','desc')
            ->orderBy('month','desc')
            ->get();
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        $monthName = $months[(int)$month] ?? $month;
        $month = $monthName;
        return view('admin.enfant.paiement.index', compact('controls', 'year', 'month'));
        // return view('admin.enfant.paiement.index');
    }
    public function PaiementAdd(){
        return view('admin.enfant.paiement.paiement_add');
    }

    public function openMonth(Request $request){

            $currentMonth = (int) date('n');
            $currentYear =  (int) date('Y');
            $request->validate([
                'month' => 'required|integer|min:1|max:12',
                'year' => 'required|integer|min:2000|max:2100',
            ]);


            $month = (int) $request->month;
            $year  = (int) $request->year;
            $userId = Auth::id();
            // dd($currentMonth,$currentYear);
            // dd($month,$year);/
            // 1) سياسة: فقط الشهر الحالي
            if ($year !== $currentYear || $month !== $currentMonth) {
                return back()->with(['message' => 'Autorisé uniquement pour le mois en cours', 'alert-type' => 'error']);
            }

        // 2) إذا مفتوح مسبقًا -> روح للجدول مباشرة
        $exists = EmployeeControl::where('year', $year)->where('month', $month)->exists();
        if ($exists) {
            // return redirect()->route('payroll.index', ['year' => $year, 'month' => $month])
            //     ->with(['message' => 'Le mois courant est déjà ouvert.', 'alert-type' => 'info']);
        return back()->with(['message' => 'Le mois courant est déjà ouvert.', 'alert-type' => 'error']);

        }

        DB::transaction(function () use ($month, $year, $userId) {

            $employees = DB::table('employes')
                ->where('statut', 'Actif')
                ->select('id', 'salaire')
                ->get();

             foreach ($employees as $emp) {

                $exists = DB::table('employee_controls')
                    ->where('employe_id', $emp->id)
                    ->where('month', $month)
                    ->where('year', $year)
                    ->exists();
                if (!$exists) {
                    DB::table('employee_controls')->insert([
                        'employe_id'       => $emp->id,
                        'month'            => $month,
                        'year'             => $year,
                        'salary_total'     => $emp->salaire,
                        'paid_total'       => 0,
                        'rest'             => $emp->salaire,
                        'advance_total'    => 0,
                        'bonus_total'      => 0,
                        'deductions_total' => 0,
                        'etat'             => 1,
                        'note'             => null,
                        'created_by'       => $userId,
                        'updated_by'       => $userId,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                }
            }
        });


        // منطق فتح الشهر هنا
        // ...
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        $monthName = $months[(int)$month] ?? $month;

        return redirect()->route('paiement.index', ['year' => $year, 'month' => $month])
            ->with([
                'message' => "La paie du mois de {$monthName} {$year} a été initialisée avec succès.",
                'alert-type' => 'success'
            ]);
    }

    public function PaiementIndex($year, $month)
        {
            $controls = EmployeeControl::with('employes')
                ->where('year', $year)
                ->where('month', $month)
                ->orderBy('etat','desc')
                ->get();
            // dd($controls);

            return view('admin.enfant.paiement.index', compact('controls', 'year', 'month'));
       }

       public function PaiementAction(Request $request, $id)
        {
            $control = EmployeeControl::findOrFail($id);



            // dd($controls);
            // dd($request->id);

            $types = [
                'Advance'    => 'Avance',
                'Salaire'    => 'Salaire',
                'Bonus'      => 'Prime',
                'Deductions' => 'Déduction',
            ];

            return view('admin.enfant.paiement.paiement_action', compact('control', 'types'));
}

public function PaiementActionStore(Request $request)
    {
        // $control = EmployeeControl::findOrFail($id);

        $request->validate([
            'type_action' => 'required|in:Advance,Salaire,Bonus,Deductions',
            'amount'      => 'required|numeric|min:0.01',
        ]);
        $control = EmployeeControl::findOrFail($request->control_id);
            $type   = $request->type_action;
            $amount = (float) $request->amount;
            $userId = Auth::id();
            $date   = now()->toDateString();
        // dd($request->all());
        DB::transaction(function () use ($control, $type, $amount, $date, $userId, $request) {

        // 2) INSERT في employee_payments (سجل العملية)
            $payment = EmployeePayment::create([
                'employee_control_id' => $control->id,

                // ⚠️ حسب صورة جدولك: العمود اسمه employee_id
                'employe_id'         => $control->employe_id,

                'type_action'         => $type,
                'amount'              => $amount,
                'payment_date'        => $date,
                'note'                => $request->note,
                'created_by'          => $userId,
                'updated_by'          => $userId,
            ]);
            $control->refresh();
            if (in_array($type, ['Advance', 'Salaire'])) {

            // منع دفع أكثر من الباقي
            if ($amount > $control->rest) {
                throw new \Exception(" Le montant saisi est supérieur au solde restant: {$control->rest}");
            }

            $control->paid_total += $amount;
            $control->rest = max(0, $control->rest - $amount);

            if ($type === 'Advance') {
                $control->advance_total += $amount;
            }
            } elseif ($type === 'Bonus') {

            // Bonus = زيادة مستحقة (ترفع الراتب المطلوب)
                $control->bonus_total  += $amount;
                $control->salary_total += $amount;
                $control->rest         += $amount;

            } elseif ($type === 'Deductions') {

                // Deductions = خصم (ينقص الراتب المطلوب)
                $control->deductions_total += $amount;
                $control->salary_total = max(0, $control->salary_total - $amount);
                $control->rest = max(0, $control->rest - $amount);
            }
            $control->etat = ($control->rest > 0) ? 1 : 0;
            $control->updated_by = $userId;
            $control->save();
            if (in_array($type, ['Advance', 'Salaire'])) {
            EcritureComptable::create([
                'type'        => 'charges',
                'categorie_id'=> 7, // ✅ غيّرها حسب فئة الرواتب عندك
                'amount'      => $amount,
                'entry_date'  => $date,
                'source_type' => 'employee_payments',
                'source_id'   => $payment->id,
                'notes'       => "Paiement {$type} - Employé ID {$control->employe_id} ({$control->month}/{$control->year})",
                'created_by'  => $userId,
                'updated_by'  => $userId,
            ]);
        }
    });
     $last = EmployeeControl::orderBy('year','desc')
                    ->orderBy('month','desc')
                    ->first();
                if ($last) {
                    $year  = $last->year;
                    $month = $last->month;
                } else {
                    $year  = (int) date('Y');
                    $month = (int) date('n');
                }
         $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        $monthName = $months[(int)$month] ?? $month;

        // return redirect()->route('paiement.index', ['year' => $year, 'month' => $monthName])
        // return view('admin.enfant.paiement.index', compact('year', 'monthName'));
         return redirect()->route('paiement.index', ['year' => $year, 'month' => $month])
            ->with([
                'message' => "Paiement enregistré avec succès.",
                'alert-type' => 'success'
            ]);

}

public function Paiementinformation($id)
    {
        $control = EmployeeControl::findOrFail($id);
        // dd($control);

        return view('admin.enfant.paiement.paiement_details', compact('control'));
    }

public function PaiementPrintId($id)
    {
        $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
            'email' => "aliwameriem@gmail.com"
        ];
            $control = EmployeeControl::with('employes')->findOrFail($id);
            $payments = EmployeePayment::where('employee_control_id', $control->id)
                ->orderBy('payment_date', 'asc')
                ->get();
            $totalPayments = $payments->sum('amount');
            $months = [
                1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
                5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
                9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
            ];
             $monthName = $months[(int)$control->month] ?? $control->month;
             $types = [
                    'Advance'    => 'Avance',
                    'Salaire'    => 'Salaire',
                    'Bonus'      => 'Prime',
                    'Deductions' => 'Déduction',
                ];

             $pdf = Pdf::loadView('admin.enfant.paiement.impressionId', compact(
                'creche', 'control', 'payments', 'totalPayments', 'monthName', 'types'
            ))->setPaper('a4', 'portrait');


          return $pdf->stream("paiement_{$control->id}.pdf");
    }



}
