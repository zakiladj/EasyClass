<?php

namespace App\Http\Controllers\Backend\Enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\AbonnementEnfant;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Enfant\EmployeePayment;

class ChartController extends Controller
{

    public function ChartJs(Request $request)
    {
         $data['allData'] = AbonnementEnfant::query()
        ->whereIn('id', function ($q) {
            $q->selectRaw('MAX(id)')
              ->from('abonnement_enfants')
              ->groupBy('enfant_id');
        })
        ->orderBy('date_debut', 'desc')
        ->get();
        $employeesCount = DB::table('employes')->count();

        // (اختياري) عدد الموظفين النشطين حسب عمود statut = 'Actif'
        $employeesActive = DB::table('employes')
            ->where('statut', 'Actif')
            ->count();

        // 2) عدد الأطفال
        // ⚠️ غيّر اسم الجدول إذا كان مختلف (مثلاً: enfants أو children)
        $childrenCount = DB::table('enfants')->count();
        // ✅ اشتراكات جارية / منتهية
        $today = Carbon::today();

        $abonEnCours = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '>=', $today)   // مازال ماكملش
            ->count();
        $abonExpirees = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '<', $today)    // كمل
            ->count();
        $data['abonEnCours'] = $abonEnCours;
        $data['abonExpirees'] = $abonExpirees;
        // ✅ مجموع الإيرادات/المصاريف للشهر الحالي من ecritures_comptables
        $monthStart = Carbon::now()->startOfMonth()->toDateString();
        $monthEnd   = Carbon::now()->endOfMonth()->toDateString();
        $revenuTotal = DB::table('ecritures_comptables')
            ->where('type', 'revenu')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $chargesTotal = DB::table('ecritures_comptables')
            ->where('type', 'charges')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $data['revenuTotal'] = $revenuTotal;
        $data['chargesTotal'] = $chargesTotal;

        // 3) عدد الاشتراكات النشطة
        // من جدول abonnement_enfants عندك عمود etat (0/1)
        $abonActiveCount = DB::table('abonnement_enfants')
            ->where('etat', 1)
            ->count();
        $data['employeesCount'] = $employeesCount;
        $data['employeesActive'] = $employeesActive;
        $data['childrenCount'] = $childrenCount;
        $data['abonActiveCount'] = $abonActiveCount;
        $preset = $request->get('preset');

        if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    }
    elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    $rows = DB::table('employee_payments')
        ->selectRaw('DATE(payment_date) as d, SUM(amount) as total')
        ->whereBetween('payment_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();
    $childRows = DB::table('child_payments')
        ->selectRaw('DATE(date_paiement) as d, SUM(payee) as total')
        ->whereBetween('date_paiement', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $data['childLabels'] = $childRows->pluck('d');
    $data['childValues'] = $childRows->pluck('total');
    //  dd($data['childValues'], $data['childLabels']);


    // ✅ (2) Fees daily (charges vs revenu)
    $feesRows = DB::table('ecritures_comptables')
        ->selectRaw("
            DATE(entry_date) as d,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $data['feesLabels']  = $feesRows->pluck('d');
    $data['feesCharges'] = $feesRows->pluck('charges');
    $data['feesRevenu']  = $feesRows->pluck('revenu');

    $labels = $rows->pluck('d');
    $values = $rows->pluck('total');
    $data['labels'] = $labels;
    $data['values'] = $values;
    $data['from'] = $from;
    $data['to'] = $to;
    // dd($data);

        return view('admin.enfant.dashboard.dashboard', $data);
    }
    public function EnfantChart(Request $request)
    {

         $data['allData'] = AbonnementEnfant::query()
        ->whereIn('id', function ($q) {
            $q->selectRaw('MAX(id)')
              ->from('abonnement_enfants')
              ->groupBy('enfant_id');
        })
        ->orderBy('date_debut', 'desc')
        ->get();
        $employeesCount = DB::table('employes')->count();

        // (اختياري) عدد الموظفين النشطين حسب عمود statut = 'Actif'
        $employeesActive = DB::table('employes')
            ->where('statut', 'Actif')
            ->count();

        // 2) عدد الأطفال
        // ⚠️ غيّر اسم الجدول إذا كان مختلف (مثلاً: enfants أو children)
        $childrenCount = DB::table('enfants')->count();
        // ✅ اشتراكات جارية / منتهية
        $today = Carbon::today();

        $abonEnCours = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '>=', $today)   // مازال ماكملش
            ->count();
        $abonExpirees = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '<', $today)    // كمل
            ->count();
        $data['abonEnCours'] = $abonEnCours;
        $data['abonExpirees'] = $abonExpirees;
        // ✅ مجموع الإيرادات/المصاريف للشهر الحالي من ecritures_comptables
        $monthStart = Carbon::now()->startOfMonth()->toDateString();
        $monthEnd   = Carbon::now()->endOfMonth()->toDateString();
        $revenuTotal = DB::table('ecritures_comptables')
            ->where('type', 'revenu')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $chargesTotal = DB::table('ecritures_comptables')
            ->where('type', 'charges')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $data['revenuTotal'] = $revenuTotal;
        $data['chargesTotal'] = $chargesTotal;

        // 3) عدد الاشتراكات النشطة
        // من جدول abonnement_enfants عندك عمود etat (0/1)
        $abonActiveCount = DB::table('abonnement_enfants')
            ->where('etat', 1)
            ->count();
        $data['employeesCount'] = $employeesCount;
        $data['employeesActive'] = $employeesActive;
        $data['childrenCount'] = $childrenCount;
        $data['abonActiveCount'] = $abonActiveCount;
        $preset = $request->get('preset');

        if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    }
    elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    $rows = DB::table('employee_payments')
        ->selectRaw('DATE(payment_date) as d, SUM(amount) as total')
        ->whereBetween('payment_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();
    $childRows = DB::table('child_payments')
        ->selectRaw('DATE(date_paiement) as d, SUM(payee) as total')
        ->whereBetween('date_paiement', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $data['childLabels'] = $childRows->pluck('d');
    $data['childValues'] = $childRows->pluck('total');
    //  dd($data['childValues'], $data['childLabels']);


    // ✅ (2) Fees daily (charges vs revenu)
    $feesRows = DB::table('ecritures_comptables')
        ->selectRaw("
            DATE(entry_date) as d,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $data['feesLabels']  = $feesRows->pluck('d');
    $data['feesCharges'] = $feesRows->pluck('charges');
    $data['feesRevenu']  = $feesRows->pluck('revenu');

    $labels = $rows->pluck('d');
    $values = $rows->pluck('total');
    $data['labels'] = $labels;
    $data['values'] = $values;
    $data['from'] = $from;
    $data['to'] = $to;
    return view('admin.enfant.dashboard.enfant_chart', $data);
    }
    public function ChargeChart(Request $request)
    {
     $data['allData'] = AbonnementEnfant::query()
        ->whereIn('id', function ($q) {
            $q->selectRaw('MAX(id)')
              ->from('abonnement_enfants')
              ->groupBy('enfant_id');
        })
        ->orderBy('date_debut', 'desc')
        ->get();
        $employeesCount = DB::table('employes')->count();

        // (اختياري) عدد الموظفين النشطين حسب عمود statut = 'Actif'
        $employeesActive = DB::table('employes')
            ->where('statut', 'Actif')
            ->count();

        // 2) عدد الأطفال
        // ⚠️ غيّر اسم الجدول إذا كان مختلف (مثلاً: enfants أو children)
        $childrenCount = DB::table('enfants')->count();
        // ✅ اشتراكات جارية / منتهية
        $today = Carbon::today();

        $abonEnCours = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '>=', $today)   // مازال ماكملش
            ->count();
        $abonExpirees = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '<', $today)    // كمل
            ->count();
        $data['abonEnCours'] = $abonEnCours;
        $data['abonExpirees'] = $abonExpirees;
        // ✅ مجموع الإيرادات/المصاريف للشهر الحالي من ecritures_comptables
        $monthStart = Carbon::now()->startOfMonth()->toDateString();
        $monthEnd   = Carbon::now()->endOfMonth()->toDateString();
        $revenuTotal = DB::table('ecritures_comptables')
            ->where('type', 'revenu')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $chargesTotal = DB::table('ecritures_comptables')
            ->where('type', 'charges')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $data['revenuTotal'] = $revenuTotal;
        $data['chargesTotal'] = $chargesTotal;

        // 3) عدد الاشتراكات النشطة
        // من جدول abonnement_enfants عندك عمود etat (0/1)
        $abonActiveCount = DB::table('abonnement_enfants')
            ->where('etat', 1)
            ->count();
        $data['employeesCount'] = $employeesCount;
        $data['employeesActive'] = $employeesActive;
        $data['childrenCount'] = $childrenCount;
        $data['abonActiveCount'] = $abonActiveCount;
        $preset = $request->get('preset');

        if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    }
    elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    $rows = DB::table('employee_payments')
        ->selectRaw('DATE(payment_date) as d, SUM(amount) as total')
        ->whereBetween('payment_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();
    $childRows = DB::table('child_payments')
        ->selectRaw('DATE(date_paiement) as d, SUM(payee) as total')
        ->whereBetween('date_paiement', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $data['childLabels'] = $childRows->pluck('d');
    $data['childValues'] = $childRows->pluck('total');
    //  dd($data['childValues'], $data['childLabels']);


    // ✅ (2) Fees daily (charges vs revenu)
    $feesRows = DB::table('ecritures_comptables')
        ->selectRaw("
            DATE(entry_date) as d,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();
    $chargesByCat = DB::table('ecritures_comptables as e')
        ->join('categories as c', 'c.id', '=', 'e.categorie_id')   // <-- بدّل categories إذا اسم جدولك مختلف
        ->where('e.type', 'charges')
        ->whereBetween('e.entry_date', [$from, $to])
        ->groupBy('c.id', 'c.name')
        ->select('c.name', DB::raw('SUM(e.amount) as total'))
        ->orderByDesc('total')
        ->get();
    $data['chargesCatLabels'] = $chargesByCat->pluck('name');
    // $data['chargesCatSeries'] = $chargesByCat->pluck('total');
    $data['chargesCatSeries'] = $chargesByCat->pluck('total')->map(fn($v) => (float) $v);
    $revenuByCat = DB::table('ecritures_comptables as e')
        ->join('categories as c', 'c.id', '=', 'e.categorie_id')
        ->where('e.type', 'revenu')
        ->whereBetween('e.entry_date', [$from, $to])
        ->groupBy('c.id', 'c.name')
        ->select('c.name', DB::raw('SUM(e.amount) as total'))
        ->orderByDesc('total')
        ->get();
    $data['revenuCatLabels'] = $revenuByCat->pluck('name');
    // $data['revenuCatSeries'] = $revenuByCat->pluck('total');
    $data['revenuCatSeries']  = $revenuByCat->pluck('total')->map(fn($v) => (float) $v);

    $data['feesLabels']  = $feesRows->pluck('d');
    $data['feesCharges'] = $feesRows->pluck('charges');
    $data['feesRevenu']  = $feesRows->pluck('revenu');

    $labels = $rows->pluck('d');
    $values = $rows->pluck('total');
    $data['labels'] = $labels;
    $data['values'] = $values;
    $data['from'] = $from;
    $data['to'] = $to;
        return view('admin.enfant.dashboard.charge_chart', $data);
    }
    public function EmployeChart(Request $request)
    {

       $data['allData'] = AbonnementEnfant::query()
        ->whereIn('id', function ($q) {
            $q->selectRaw('MAX(id)')
              ->from('abonnement_enfants')
              ->groupBy('enfant_id');
        })
        ->orderBy('date_debut', 'desc')
        ->get();
        $employeesCount = DB::table('employes')->count();

        // (اختياري) عدد الموظفين النشطين حسب عمود statut = 'Actif'
        $employeesActive = DB::table('employes')
            ->where('statut', 'Actif')
            ->count();

        // 2) عدد الأطفال
        // ⚠️ غيّر اسم الجدول إذا كان مختلف (مثلاً: enfants أو children)
        $childrenCount = DB::table('enfants')->count();
        // ✅ اشتراكات جارية / منتهية
        $today = Carbon::today();

        $abonEnCours = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '>=', $today)   // مازال ماكملش
            ->count();
        $abonExpirees = DB::table('abonnement_enfants')
            ->whereDate('date_fin', '<', $today)    // كمل
            ->count();
        $data['abonEnCours'] = $abonEnCours;
        $data['abonExpirees'] = $abonExpirees;
        // ✅ مجموع الإيرادات/المصاريف للشهر الحالي من ecritures_comptables
        $monthStart = Carbon::now()->startOfMonth()->toDateString();
        $monthEnd   = Carbon::now()->endOfMonth()->toDateString();
        $revenuTotal = DB::table('ecritures_comptables')
            ->where('type', 'revenu')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $chargesTotal = DB::table('ecritures_comptables')
            ->where('type', 'charges')
            ->whereBetween('entry_date', [$monthStart, $monthEnd])
            ->sum('amount');
        $data['revenuTotal'] = $revenuTotal;
        $data['chargesTotal'] = $chargesTotal;

        // 3) عدد الاشتراكات النشطة
        // من جدول abonnement_enfants عندك عمود etat (0/1)
        $abonActiveCount = DB::table('abonnement_enfants')
            ->where('etat', 1)
            ->count();
        $data['employeesCount'] = $employeesCount;
        $data['employeesActive'] = $employeesActive;
        $data['childrenCount'] = $childrenCount;
        $data['abonActiveCount'] = $abonActiveCount;
        $preset = $request->get('preset');

        if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    }
    elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    $rows = DB::table('employee_payments')
        ->selectRaw('DATE(payment_date) as d, SUM(amount) as total')
        ->whereBetween('payment_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();
    $childRows = DB::table('child_payments')
        ->selectRaw('DATE(date_paiement) as d, SUM(payee) as total')
        ->whereBetween('date_paiement', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $data['childLabels'] = $childRows->pluck('d');
    $data['childValues'] = $childRows->pluck('total');
    //  dd($data['childValues'], $data['childLabels']);


    // ✅ (2) Fees daily (charges vs revenu)
    $feesRows = DB::table('ecritures_comptables')
        ->selectRaw("
            DATE(entry_date) as d,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $data['feesLabels']  = $feesRows->pluck('d');
    $data['feesCharges'] = $feesRows->pluck('charges');
    $data['feesRevenu']  = $feesRows->pluck('revenu');

    $labels = $rows->pluck('d');
    $values = $rows->pluck('total');
    $data['labels'] = $labels;
    $data['values'] = $values;
    $data['from'] = $from;
    $data['to'] = $to;
        return view('admin.enfant.dashboard.employe_chart', $data);
    }


    // Print Chart Enfant


public function EnfantChartPrint(Request $request)
{
    // نفس منطق preset/from/to
    $preset = $request->get('preset');
    if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    } elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    // ✅ 1) تفاصيل مدفوعات الأطفال
    $childPayments = DB::table('child_payments')
        ->select('id','abonnement_enfant_id','payee','total','rest_pay','date_paiement','note','created_at')
        ->whereBetween('date_paiement', [$from, $to])
        ->orderBy('date_paiement')
        ->get();

    // ✅ مجموع مدفوعات الأطفال (إجمالي)
    $childTotal = DB::table('child_payments')
        ->whereBetween('date_paiement', [$from, $to])
        ->sum('payee');

    // ✅ 2) تفاصيل القيود المحاسبية (Charges / Revenu)
    $feesDetails = DB::table('ecritures_comptables')
        ->select('id','type','amount','entry_date','source_type','source_id','notes','created_at')
        ->whereBetween('entry_date', [$from, $to])
        ->orderBy('entry_date')
        ->get();

    // ✅ مجموع المصاريف والإيرادات في نفس الفترة (باش ما يكونش اختلاف)
    $chargesTotal = DB::table('ecritures_comptables')
        ->where('type','charges')
        ->whereBetween('entry_date', [$from, $to])
        ->sum('amount');

    $revenuTotal = DB::table('ecritures_comptables')
        ->where('type','revenu')
        ->whereBetween('entry_date', [$from, $to])
        ->sum('amount');

    // ✅ 3) ملخص يومي (للطباعة كجدول)
    $childDaily = DB::table('child_payments')
        ->selectRaw("DATE(date_paiement) as d, SUM(payee) as total")
        ->whereBetween('date_paiement', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $feesDaily = DB::table('ecritures_comptables')
        ->selectRaw("
            DATE(entry_date) as d,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    return view('admin.enfant.dashboard.enfant_print', compact(
        'preset','from','to',
        'childPayments','childTotal','childDaily',
        'feesDetails','chargesTotal','revenuTotal','feesDaily'
    ));
}
public function ChartPrint(Request $request)
{
    // نفس منطق preset/from/to
    $preset = $request->get('preset');
    if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    } elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    // ✅ 1) تفاصيل مدفوعات الأطفال
    $childPayments = DB::table('child_payments')
        ->select('id','abonnement_enfant_id','payee','total','rest_pay','date_paiement','note','created_at')
        ->whereBetween('date_paiement', [$from, $to])
        ->orderBy('date_paiement')
        ->get();

    // ✅ مجموع مدفوعات الأطفال (إجمالي)
    $childTotal = DB::table('child_payments')
        ->whereBetween('date_paiement', [$from, $to])
        ->sum('payee');

    // ✅ 2) تفاصيل القيود المحاسبية (Charges / Revenu)
    $feesDetails = DB::table('ecritures_comptables')
        ->select('id','type','amount','entry_date','source_type','source_id','notes','created_at')
        ->whereBetween('entry_date', [$from, $to])
        ->orderBy('entry_date')
        ->get();

    // ✅ مجموع المصاريف والإيرادات في نفس الفترة (باش ما يكونش اختلاف)
    $chargesTotal = DB::table('ecritures_comptables')
        ->where('type','charges')
        ->whereBetween('entry_date', [$from, $to])
        ->sum('amount');

    $revenuTotal = DB::table('ecritures_comptables')
        ->where('type','revenu')
        ->whereBetween('entry_date', [$from, $to])
        ->sum('amount');

    // ✅ 3) ملخص يومي (للطباعة كجدول)
    $childDaily = DB::table('child_payments')
        ->selectRaw("DATE(date_paiement) as d, SUM(payee) as total")
        ->whereBetween('date_paiement', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $feesDaily = DB::table('ecritures_comptables')
        ->selectRaw("
            DATE(entry_date) as d,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    return view('admin.enfant.dashboard.chart_print', compact(
        'preset','from','to',
        'childPayments','childTotal','childDaily',
        'feesDetails','chargesTotal','revenuTotal','feesDaily'
    ));
}
public function EmployeeChartPrint(Request $request)
{
    $preset = $request->get('preset');

    if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    } elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    // ✅ 1) Daily مجموع مدفوعات الموظفين
    $empDaily = DB::table('employee_payments')
        ->selectRaw('DATE(payment_date) as d, SUM(amount) as total')
        ->whereBetween('payment_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $empTotal = DB::table('employee_payments')
        ->whereBetween('payment_date', [$from, $to])
        ->sum('amount');

    // ✅ 2) تفاصيل عمليات الموظفين

$empPayments = EmployeePayment::with('employe')
    ->whereBetween('payment_date', [$from, $to])
    ->orderByDesc('payment_date')
    ->get();

    // ✅ 3) القيود المحاسبية المرتبطة بمدفوعات الموظفين فقط
    // ملاحظة: في جدول ecritures_comptables عندك source_type = employee_payments
    $empAccounting = DB::table('ecritures_comptables')
        ->where('source_type', 'employee_payments')
        ->whereBetween('entry_date', [$from, $to])
        ->orderBy('entry_date', 'asc')
        ->get();

    // مجموع المصاريف الخاصة بالموظفين من القيود (اختياري لكن مفيد)
    $empChargesTotal = DB::table('ecritures_comptables')
        ->where('source_type', 'employee_payments')
        ->where('type', 'charges')
        ->whereBetween('entry_date', [$from, $to])
        ->sum('amount');

    return view('admin.enfant.dashboard.employee_print', [
        'preset'          => $preset,
        'from'            => $from,
        'to'              => $to,
        'empDaily'        => $empDaily,
        'empTotal'        => $empTotal,
        'empPayments'     => $empPayments,
        'empAccounting'   => $empAccounting,
        'empChargesTotal' => $empChargesTotal,
    ]);
}


public function ChargePrint(Request $request)
{
    $preset = $request->get('preset');

    if ($preset === 'today') {
        $from = now()->toDateString();
        $to   = now()->toDateString();
    } elseif ($preset === 'week') {
        $from = now()->startOfWeek()->toDateString();
        $to   = now()->endOfWeek()->toDateString();
    } elseif ($preset === 'month') {
        $from = now()->startOfMonth()->toDateString();
        $to   = now()->endOfMonth()->toDateString();
    } elseif ($preset === 'year') {
        $from = now()->startOfYear()->toDateString();
        $to   = now()->endOfYear()->toDateString();
    } else {
        $from = $request->get('from', now()->subDays(30)->toDateString());
        $to   = $request->get('to', now()->toDateString());
    }

    // ✅ 1) ملخص عام من ecritures_comptables حسب الفترة
    $revenuTotal = DB::table('ecritures_comptables')
        ->where('type', 'revenu')
        ->whereBetween('entry_date', [$from, $to])
        ->sum('amount');

    $chargesTotal = DB::table('ecritures_comptables')
        ->where('type', 'charges')
        ->whereBetween('entry_date', [$from, $to])
        ->sum('amount');

    // ✅ 2) يوميًا (مصاريف/إيرادات) نفس الشارت
    $feesDaily = DB::table('ecritures_comptables')
        ->selectRaw("
            DATE(entry_date) as d,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    // ✅ 3) تفاصيل القيود (كل القيود في الفترة)
    $feesDetails = DB::table('ecritures_comptables')
        ->whereBetween('entry_date', [$from, $to])
        ->orderBy('entry_date')
        ->orderBy('id')
        ->get();

    // ✅ 4) تفصيل حسب categorie_id (مصاريف وإيرادات)
    // $byCategorie = DB::table('ecritures_comptables')
    //     ->selectRaw("
    //         categorie_id,
    //         SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges_total,
    //         SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu_total
    //     ")
    //     ->whereBetween('entry_date', [$from, $to])
    //     ->groupBy('categorie_id')
    //     ->orderBy('categorie_id')
    //     ->get();
    $byCategorie = DB::table('ecritures_comptables as e')
    ->leftJoin('categories as c', 'c.id', '=', 'e.categorie_id') // ← عدّل اسم الجدول إذا لازم
    ->selectRaw("
        e.categorie_id,
        COALESCE(c.name, 'غير مصنف') as category_name,
        SUM(CASE WHEN e.type='charges' THEN e.amount ELSE 0 END) as charges_total,
        SUM(CASE WHEN e.type='revenu' THEN e.amount ELSE 0 END) as revenu_total
    ")
    ->whereBetween('e.entry_date', [$from, $to])
    ->groupBy('e.categorie_id', 'c.name')
    ->orderBy('e.categorie_id')
    ->get();


    // ✅ 5) تفصيل حسب المصدر source_type (اشتراكات الأطفال / employee_payments / ...)
    $bySourceType = DB::table('ecritures_comptables')
        ->selectRaw("
            source_type,
            SUM(CASE WHEN type='charges' THEN amount ELSE 0 END) as charges_total,
            SUM(CASE WHEN type='revenu' THEN amount ELSE 0 END) as revenu_total
        ")
        ->whereBetween('entry_date', [$from, $to])
        ->groupBy('source_type')
        ->orderBy('source_type')
        ->get();

    // ✅ 6) تفصيل مصاريف الموظفين حسب type_action من employee_payments (داخل نفس الفترة)
    $employeeChargesByTypeAction = DB::table('employee_payments')
        ->selectRaw("type_action, SUM(amount) as total")
        ->whereBetween('payment_date', [$from, $to])
        ->groupBy('type_action')
        ->orderBy('type_action')
        ->get();

    // ✅ 7) تفصيل إيرادات الاشتراكات (child_payments) حسب اليوم + مجموع الفترة
    $childDaily = DB::table('child_payments')
        ->selectRaw('DATE(date_paiement) as d, SUM(payee) as total')
        ->whereBetween('date_paiement', [$from, $to])
        ->groupBy('d')
        ->orderBy('d')
        ->get();

    $childTotal = DB::table('child_payments')
        ->whereBetween('date_paiement', [$from, $to])
        ->sum('payee');

    // ✅ 8) تفاصيل مدفوعات الأطفال
    $childPayments = DB::table('child_payments')
        ->whereBetween('date_paiement', [$from, $to])
        ->orderBy('date_paiement')
        ->orderBy('id')
        ->get();

    return view('admin.enfant.dashboard.charge_print', compact(
        'from','to','preset',
        'revenuTotal','chargesTotal',
        'feesDaily','feesDetails',
        'byCategorie','bySourceType',
        'employeeChargesByTypeAction',
        'childDaily','childTotal','childPayments'
    ));
}







}
