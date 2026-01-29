<?php

namespace App\Http\Controllers\Backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\Enfant;
use App\Models\Enfant\Abonnement;
use App\Models\Enfant\EcritureComptable;
use App\Models\Enfant\ChildPaiement;
use Illuminate\Support\Facades\DB;
use App\Models\Enfant\AbonnementEnfant;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AbmEnfantController extends Controller
{

    public function AbmEnfantView(){

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

        // 3) عدد الاشتراكات النشطة
        // من جدول abonnement_enfants عندك عمود etat (0/1)
        $abonActiveCount = DB::table('abonnement_enfants')
            ->where('etat', 1)
            ->count();
        $data['employeesCount'] = $employeesCount;
        $data['employeesActive'] = $employeesActive;
        $data['childrenCount'] = $childrenCount;
        $data['abonActiveCount'] = $abonActiveCount;


        return view('admin.enfant.abm_enfant.abmenfant_view', $data);
    }

    public function AbmEnfantAdd(){

        $data['abonnements'] = Abonnement::all();
        $data['enfant'] = Enfant::find(request()->route('id_enfant'));
        // dd($data['abonnements']);
        return view('admin.enfant.abm_enfant.abmenfant_add', $data);

    }
    public function AbmEnfantStore(Request $request){
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'abonnement' => 'required',
            'total_final' => 'required|numeric|min:0',
            'payer' => 'required|numeric|min:0',
            'rest' => 'required|numeric|min:0',
            // categorie_id مهم لتسجيل القيد المحاسبي

        ]);
        $userId = Auth::id();
  try    {
        DB::transaction(function () use ($request, $userId) {

        // ✅ 0) جلب الطفل للحصول على pere_id (إذا موجود)
        $enfant = Enfant::findOrFail($request->enfant_id);

        // ✅ 1) INSERT abonnement_enfants
        $abm = new AbonnementEnfant();
        $abm->abonement_id      = $request->abonnement;   // حسب اسمك في الجدول/الموديل
        $abm->enfant_id         = $request->enfant_id;
        $abm->date_debut        = $request->date_debut;
        $abm->date_fin          = $request->date_fin;
        $abm->date_paiement     = $request->date_paiement ?? now();
        $abm->montant           = $request->total_final;
        $abm->frais_inscription = $request->frais_inscription ?? 0;
        $abm->frais_livres      = $request->frais_livres ?? 0;
        $abm->remise            = $request->remise ?? 0;
        $abm->etat              = 1;
        $abm->paye              = $request->payer;
        $abm->rest_paye         = $request->rest;
        $abm->created_by        = $userId;
        $abm->updated_by        = $userId;
        $abm->save();
                // ✅ 2) INSERT child_payments
        $payment = new ChildPaiement();
        $payment->pere_id              = null; // إذا pere_id في enfant
        $payment->abonnement_enfant_id = $abm->id;
        $payment->total                = $request->total_final;
        $payment->payee                = $request->payer;
        $payment->rest_pay             = $request->rest;
        $payment->date_paiement        = $request->date_paiement ?? now();
        $payment->note                 = $request->note ?? null;
        $payment->created_by           = $userId;
        $payment->updated_by           = $userId;
        $payment->save();
                // ✅ 3) INSERT ecritures_comptables
        // نسجل "revenu" بمبلغ المدفوع الآن (payee)
        // source_type + source_id لربط القيد بالدفع
        $ecriture = new EcritureComptable();
        $ecriture->type        = 'revenu';
        $ecriture->categorie_id= 8; // مثلا: catégorie "Abonnements enfants"
        $ecriture->amount      = $payment->payee;        // المبلغ المدفوع الآن
        $ecriture->entry_date  = $payment->date_paiement;
        $ecriture->source_type = 'child_payments';
        $ecriture->source_id   = $payment->id;
        $ecriture->notes       = $request->notes
            ?? ('Paiement abonnement enfant ID: '.$abm->enfant_id.' / AbmID: '.$abm->id);
        $ecriture->created_by  = $userId;
        $ecriture->updated_by  = $userId;
        $ecriture->save();

        }); // نهاية المعاملة
        } catch (\Throwable $e) {
            Log::error('Abonnement insert failed', [
                'error' => $e->getMessage(),
            ]);

            return back()->with([
                'message' => 'Erro : ' . $e->getMessage(),
                'alert-type' => 'error'
            ])->withInput();
        }

        $notification = array(
            'message' => 'Abonnement Enfant Inséré avec succès',
            'alert-type' => 'success'
        );
             $enfant = Enfant::find($request->enfant_id);
             $allData = AbonnementEnfant::all();
             $employeesCount = DB::table('employes')->count();

        // (اختياري) عدد الموظفين النشطين حسب عمود statut = 'Actif'
            $employeesActive = DB::table('employes')
                ->where('statut', 'Actif')
                ->count();

            // 2) عدد الأطفال
            // ⚠️ غيّر اسم الجدول إذا كان مختلف (مثلاً: enfants أو children)
            $childrenCount = DB::table('enfants')->count();

            // 3) عدد الاشتراكات النشطة
            // من جدول abonnement_enfants عندك عمود etat (0/1)
            $abonActiveCount = DB::table('abonnement_enfants')
                ->where('etat', 1)
                ->count();
            $data['employeesCount'] = $employeesCount;
            $data['employeesActive'] = $employeesActive;
            $data['childrenCount'] = $childrenCount;
            $data['abonActiveCount'] = $abonActiveCount;
            $data['allData'] = $allData;
            $data['enfant'] = $enfant;
            $data = array_merge($data, $notification);
        // $enfant = Enfant::find($request->enfant_id);
        // $allData = AbonnementEnfant::all();

        // return view('admin.enfant.abm_enfant.abmenfant_view', compact('allData', 'enfant'))->with($notification);
        return view('admin.enfant.abm_enfant.abmenfant_view', $data);



    }
    public function AbmEnfantImpression($id){
        $abonnement = AbonnementEnfant::find($id);

         $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];

        $client = [
            'nom' => $abonnement->enfant->nom,
            'prenom' => $abonnement->enfant->prenom,
            'address' => $abonnement->enfant->adresse,
            'phone' => $abonnement->enfant->telephone,
            'abonnement_date' =>Carbon::parse($abonnement->date_fin)->locale('fr')->translatedFormat('F Y'),
        ];

        // البنود: description بالفرنسي كما طلبت
        $items = [
            ['id' => 1, 'description' => $abonnement->abonnement->titre, 'quantity' => 1, 'unit_price' => $abonnement->abonnement->prix],
            ['id' => 2, 'description' => "Frais d'inscription", 'quantity' => 1, 'unit_price' => $abonnement->frais_inscription],
            ['id' => 2, 'description' => "Frais Des Livres", 'quantity' => 1, 'unit_price' => $abonnement->frais_livres],
            // أمثلة إضافية
        ];
        // 🔥 حذف البنود التي قيمتها NULL فقط
        $items = array_filter($items, function ($item) {
            return $item['unit_price'] !== null;
        });

        // إعادة ترتيب الفهارس
        $items = array_values($items);

        // حسابات
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['quantity'] * $item['unit_price'];
        }
        $tax = 0; // إذا أردت إضافة ضريبة ضع قيمة هنا
        $remise = $abonnement->remise ?? 0;
        $total_after_remise = ($subtotal + $tax) - $remise;
        if ($total_after_remise < 0) $total_after_remise = 0;

        $data = [
            'creche' => $creche,
            'client' => $client,
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'remise' => $remise,
            // 'total_after_remise' => $abonnement->montant,
            'payer' => $abonnement->paye,   // 🔥 أضف هذا
            'rest' => $abonnement->rest_paye,
            'montant' => $abonnement->montant,
            'receipt_id' => sprintf('RC-%s-%s', date('Ymd'), $abonnement->enfant->id),
            'date' => Carbon::now()->format('d/m/Y'),
            ];

        $pdf = PDF::loadView('admin.enfant.pdf.invoice2', $data)->setPaper('A4', 'portrait');

        // خيار 1: عرض في المتصفح
        return $pdf->stream("recu_{$data['receipt_id']}.pdf");

        // خيار 2: تنزيل
        // return $pdf->download("recu_{$data['receipt_id']}.pdf");

        // خيار 3: حفظ في public
        // $output = $pdf->output();
        // file_put_contents(public_path("recu_{$data['receipt_id']}.pdf"), $output);
        // return response()->json(['saved' => true, 'path' => url("recu_{$data['receipt_id']}.pdf")]);

    }
     public function AbmEnfantImpressionRest($id){
        $abonnement = AbonnementEnfant::find($id);

         $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];

        $client = [
            'nom' => $abonnement->enfant->nom,
            'prenom' => $abonnement->enfant->prenom,
            'address' => $abonnement->enfant->adresse,
            'phone' => $abonnement->enfant->telephone,
            'abonnement_date' =>Carbon::parse($abonnement->date_fin)->locale('fr')->translatedFormat('F Y'),
        ];

        // البنود: description بالفرنسي كما طلبت
        $items = [
            ['id' => 1, 'description' => $abonnement->abonnement->titre, 'quantity' => 1, 'unit_price' => $abonnement->abonnement->prix],
            // ['id' => 2, 'description' => "Frais d'inscription", 'quantity' => 1, 'unit_price' => $abonnement->frais_inscription],
            // ['id' => 2, 'description' => "Frais Des Livres", 'quantity' => 1, 'unit_price' => $abonnement->frais_livres],
             ['id' => 2, 'description' => "Reste à payer", 'quantity' => 1, 'unit_price' => $abonnement->rest_paye],

            // أمثلة إضافية
        ];
        // 🔥 حذف البنود التي قيمتها NULL فقط
        $items = array_filter($items, function ($item) {
            return $item['unit_price'] !== null;
        });

        // إعادة ترتيب الفهارس
        $items = array_values($items);

        // حسابات
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['quantity'] * $item['unit_price'];
        }
        $tax = 0; // إذا أردت إضافة ضريبة ضع قيمة هنا
        $remise = $abonnement->remise ?? 0;
        $total_after_remise = ($subtotal + $tax) - $remise;
        if ($total_after_remise < 0) $total_after_remise = 0;

        $data = [
            'creche' => $creche,
            'client' => $client,
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'remise' => $remise,
            'total_after_remise' => $total_after_remise,
            'payer' => $abonnement->paye,   // 🔥 أضف هذا
            'rest' => $abonnement->rest_paye,
            'montant' => $abonnement->montant,
            'receipt_id' => sprintf('RC-%s-%s', date('Ymd'), $abonnement->enfant->id),
            'date' => Carbon::now()->format('d/m/Y'),
            ];

        $pdf = PDF::loadView('admin.enfant.pdf.invoice2', $data)->setPaper('A4', 'portrait');

        // خيار 1: عرض في المتصفح
        return $pdf->stream("recu_{$data['receipt_id']}.pdf");

        // خيار 2: تنزيل
        // return $pdf->download("recu_{$data['receipt_id']}.pdf");

        // خيار 3: حفظ في public
        // $output = $pdf->output();
        // file_put_contents(public_path("recu_{$data['receipt_id']}.pdf"), $output);
        // return response()->json(['saved' => true, 'path' => url("recu_{$data['receipt_id']}.pdf")]);

    }

    public function AbmEnfantRenew($id){

        $data['abonnement_enfant'] = AbonnementEnfant::find($id);
        $data['abonnements'] = Abonnement::find($data['abonnement_enfant']->abonement_id);
        $data['enfant'] = Enfant::find($data['abonnement_enfant']->enfant_id);

    //    dd($data['abonnement_enfant']);
        // dd($data['abonnements']);
        return view('admin.enfant.abm_enfant.abmenfant_renew', $data);

    }

    public function AbmEnfantRenewStore(Request $request){
            // $request->validate([
            //     'enfant_id'   => 'required|exists:enfants,id',
            //     'abonnement'  => 'required',
            //     'total_final' => 'required|numeric|min:0',
            //     'payer'       => 'required|numeric|min:0',
            //     'rest'        => 'required|numeric|min:0',
            //     'date_debut'  => 'required|date',
            //     'date_fin'    => 'required|date|after_or_equal:date_debut',
            //     'date_paiement' => 'nullable|date',
            //     'note'        => 'nullable|string|max:255',
            // ]);
            $userId = Auth::id();
        try    {
            DB::transaction(function () use ($request, $userId) {
            // ✅ 1) INSERT abonnement_enfants
             // ✅ 0) جلب الطفل (لو تحتاج pere_id)
                $enfant = Enfant::findOrFail($request->enfant_id);

                // ✅ 1) INSERT abonnement_enfants (تجديد = اشتراك جديد بسطر جديد)
                $abm = new AbonnementEnfant();
                $abm->abonement_id      = $request->abonnement;
                $abm->enfant_id         = $request->enfant_id;
                $abm->date_debut        = $request->date_debut;
                $abm->date_fin          = $request->date_fin;
                $abm->date_paiement     = $request->date_paiement ?? now();
                $abm->montant           = $request->total_final;

                // إذا عندك frais_inscription/frais_livres في التجديد خليهم 0 أو استقبلهم من الفورم
                $abm->frais_inscription = $request->frais_inscription ?? 0;
                $abm->frais_livres      = $request->frais_livres ?? 0;

                $abm->remise            = $request->remise ?? 0;
                $abm->etat              = 1;
                $abm->paye              = $request->payer;
                $abm->rest_paye         = $request->rest;
                $abm->created_by        = $userId;
                $abm->updated_by        = $userId;
                $abm->save();
                 // ✅ 2) INSERT child_payments (سجل الدفع لهذا التجديد)
                $payment = new ChildPaiement();
                // إذا عندك pere_id داخل enfant استعمله:
                // $payment->pere_id = $enfant->pere_id ?? null;

                $payment->pere_id              = null;
                $payment->abonnement_enfant_id = $abm->id;
                $payment->total                = $request->total_final;
                $payment->payee                = $request->payer;
                $payment->rest_pay             = $request->rest;
                $payment->date_paiement        = $request->date_paiement ?? now();
                $payment->note                 = $request->note ?? null;
                $payment->created_by           = $userId;
                $payment->updated_by           = $userId;
                $payment->save();
            if ($payment->payee > 0) {
                $ecriture = new EcritureComptable();
                $ecriture->type        = 'revenu';
                $ecriture->categorie_id= 8; // فئة اشتراكات الأطفال عندك
                $ecriture->amount      = $payment->payee;
                $ecriture->entry_date  = $payment->date_paiement;
                $ecriture->source_type = 'child_payments';
                $ecriture->source_id   = $payment->id;
                $ecriture->notes       = $request->notes
                    ?? ('Renouvellement abonnement enfant ID: '.$abm->enfant_id.' / AbmID: '.$abm->id);
                $ecriture->created_by  = $userId;
                $ecriture->updated_by  = $userId;
                $ecriture->save();
            }
             });
             }catch (\Throwable $e) {
                Log::error('Renew abonnement insert failed', [
                    'error' => $e->getMessage(),
                ]);

                return back()->with([
                    'message' => 'Erreur : ' . $e->getMessage(),
                    'alert-type' => 'error'
                ])->withInput();
            }
             $notification = [
                'message' => 'Renouvellement Abonnement Enfant + Paiement + Ecriture insérés avec succès',
                'alert-type' => 'success'
            ];

             $enfant = Enfant::find($request->enfant_id);
             $allData = AbonnementEnfant::all();
             $employeesCount = DB::table('employes')->count();

        // (اختياري) عدد الموظفين النشطين حسب عمود statut = 'Actif'
            $employeesActive = DB::table('employes')
                ->where('statut', 'Actif')
                ->count();

            // 2) عدد الأطفال
            // ⚠️ غيّر اسم الجدول إذا كان مختلف (مثلاً: enfants أو children)
            $childrenCount = DB::table('enfants')->count();

            // 3) عدد الاشتراكات النشطة
            // من جدول abonnement_enfants عندك عمود etat (0/1)
            $abonActiveCount = DB::table('abonnement_enfants')
                ->where('etat', 1)
                ->count();
            $data['employeesCount'] = $employeesCount;
            $data['employeesActive'] = $employeesActive;
            $data['childrenCount'] = $childrenCount;
            $data['abonActiveCount'] = $abonActiveCount;
            $data['allData'] = $allData;
            $data['enfant'] = $enfant;
            $data = array_merge($data, $notification);


            //  return view('admin.enfant.abm_enfant.abmenfant_view', compact('allData', 'enfant','data'))
             return view('admin.enfant.abm_enfant.abmenfant_view', $data);



    }
            public function AbmEnfantResteView(Request $request)
            {
                // نجيب الاشتراكات التي عندها على الأقل دفعة فيها rest_pay > 0
                $abonnements = AbonnementEnfant::query()
                    ->with([
                        'enfant', // الطفل
                        // نجيب فقط الدفعات اللي فيها باقي، ونرتبها باش نجيب آخر وحدة
                        'payments' => function ($q) {
                            $q->where('rest_pay', '>', 0)
                            ->orderByDesc('date_paiement')
                            ->orderByDesc('id');
                        }
                    ])
                    ->whereHas('payments', function ($q) {
                        $q->where('rest_pay', '>', 0);
                    })
                    ->orderByDesc('date_debut')
                    ->paginate(20);
                                 $enfant = Enfant::find($request->enfant_id);
             $allData = AbonnementEnfant::all();
             $employeesCount = DB::table('employes')->count();

        // (اختياري) عدد الموظفين النشطين حسب عمود statut = 'Actif'
            $employeesActive = DB::table('employes')
                ->where('statut', 'Actif')
                ->count();

            // 2) عدد الأطفال
            // ⚠️ غيّر اسم الجدول إذا كان مختلف (مثلاً: enfants أو children)
            $childrenCount = DB::table('enfants')->count();

            // 3) عدد الاشتراكات النشطة
            // من جدول abonnement_enfants عندك عمود etat (0/1)
            $abonActiveCount = DB::table('abonnement_enfants')
                ->where('etat', 1)
                ->count();
            $notification = [
                'message' => 'Renouvellement Abonnement Enfant + Paiement + Ecriture insérés avec succès',
                'alert-type' => 'success'
            ];
            $data['abonnements'] = $abonnements;
            // dd($data['abonnements']);

            $data['employeesCount'] = $employeesCount;
            $data['employeesActive'] = $employeesActive;
            $data['childrenCount'] = $childrenCount;
            $data['abonActiveCount'] = $abonActiveCount;
            $data['allData'] = $allData;
            $data['enfant'] = $enfant;
            $data = array_merge($data, $notification);
                    // dd('this is Abonnements Enfants',$abonnements);

                // return view('admin.enfant.abonnements_reste', compact('abonnements'));
                return view('admin.enfant.abonnements_reste', $data);
            }




}
