<?php

namespace App\Http\Controllers\Backend\Enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\Category;
use App\Models\Enfant\Charge;
use App\Models\Enfant\Fournisseur;
use App\Models\Enfant\EcritureComptable;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;



class ChargeController extends Controller
{
    public function ChargeView(){
        $data['allData'] = Charge::all();
        return view('admin.enfant.charge.charge_view', $data);
        // return view('admin.enfant.charge.charge_view');
    }
    public function ChargeAdd(){
        $allData = Category::where('type', 'charges')->get();
        $fournisseurs = Fournisseur::all();
        return view('admin.enfant.charge.charge_add', compact('allData','fournisseurs'));
    //     return view('admin.enfant.charge.charge_add');
    }

   public function ChargeStore(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required',
        'charge' => 'required',          // category_id
        'fournisseur' => 'required',     // vendeur
        'montant' => 'required|numeric|min:0.01',
        'date_charge' => 'required|date',
        'attachment' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    DB::transaction(function () use ($request) {

        // 1) رفع الملف
        $filePath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/charges', $filename, 'public');
        }

        // 2) إدخال المصروف في جدول charges
        $charge = new Charge();
        $charge->nom = $request->nom;
        $charge->category_id = $request->charge;      // تصنيف المصروف
        $charge->vendeur = $request->fournisseur;     // المورد/البائع
        $charge->montant = $request->montant;
        $charge->date_charge = $request->date_charge;
        $charge->note = $request->note ?? ('charge de : ' . $request->nom);
        $charge->attachment = $filePath;
        $charge->save();

        // 3) إدخال القيد المحاسبي في ecritures_comptables
        EcritureComptable::create([
            'type'        => 'charges',                 // لأنه مصروف
            'categorie_id'=> $charge->category_id,      // نفس التصنيف
            'amount'      => $charge->montant,
            'entry_date'  => $charge->date_charge,      // تاريخ العملية الحقيقي
            'source_type' => Charge::class,             // "App\Models\Charge"
            'source_id'   => $charge->id,               // رقم المصروف الذي أضفناه
            'notes'       => $charge->note ?? ('charge de : ' . $charge->nom),
        ]);
    });

    $notification = [
        'message' => 'Charge Insérée avec succès + écriture comptable ajoutée',
        'alert-type' => 'success'
    ];

    return redirect()->route('charge.view')->with($notification);
}
    public function ChargeImpression(){
        $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];

        $mois = Carbon::now()->locale('fr')->translatedFormat('F'); // décembre
        $annee = Carbon::now()->year;
        $anneeScolaire = date('Y') . "/" . (date('Y') + 1);
        $charges = Charge::with(['category', 'fournisseur'])->orderByDesc('date_charge')->get();
        $total = $charges->count();
        $somme = $charges->sum('montant');
         $pdf = Pdf::loadView(
                'admin.enfant.charge.charges_impression',
                compact('charges', 'creche', 'anneeScolaire', 'total', 'somme', 'mois', 'annee')
            )->setPaper('a4', 'portrait');

     return $pdf->stream('charges_impression.pdf');
    }

    public function ChargeIdImpression($id){
        $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];

        $charge = Charge::with(['category', 'fournisseur'])->findOrFail($id);
         $anneeScolaire = date('Y') . "/" . (date('Y') + 1);
        $mois = $charge->date_charge
        ? Carbon::parse($charge->date_charge)->locale('fr')->translatedFormat('F')
        : Carbon::now()->locale('fr')->translatedFormat('F');
        $annee = $charge->date_charge ? Carbon::parse($charge->date_charge)->year : Carbon::now()->year;

         $pdf = Pdf::loadView(
                'admin.enfant.charge.charge_id_impression',
                compact('charge', 'creche', 'anneeScolaire', 'mois', 'annee')
            )->setPaper('a4', 'portrait');

     return $pdf->stream('charge_impression.pdf');
    }
}
