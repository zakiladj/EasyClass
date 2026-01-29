<?php

namespace App\Http\Controllers\backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Enfant\Enfant;
use App\Models\Enfant\class_enfants;
use App\Models\Enfant\AbonnementEnfant;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class EnfantController extends Controller
{
    public function EnfantView(){


        // $data['allData'] = Enfant::orderBy('id', 'desc')->get();
        $data['allData'] = Enfant::orderBy('created_at', 'desc')->get();
        // $data['allData'] = Enfant::orderBy('date_inscription', 'desc')->get();
        // dd($data['allData']);
        return view('admin.enfant.enfant_view', $data);
    }



    public function EnfantAdd(){
        // $classes = class_enfants::all();
        $classes = class_enfants::where('place_disponible', '>', 0)->get();
        return view('admin.enfant.enfant_add', compact('classes'));
    }

    public function EnfantStore(Request $request){
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'image' => 'required',
            'date_naissance' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'medical' => 'required',
            'address' => 'required',
            'info_medicals' => 'required',
            'medical' => 'required',
            'date_debut' => 'required',
            'classe' => 'required',
            'telephone' => 'required',
        ]);
        $data = new Enfant();
        $data->nom = $request->nom;
        $data->prenom = $request->prenom;
        $data->date_naissance = $request->date_naissance;
        $data->date_inscription = $request->date_debut;
        $data->sexe = $request->gender;
        $data->	adresse = $request->address;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/enfant/'), $filename);
            $data['image'] = $filename;
        }
        $data->allergies = $request->allergies;
        $data->infos_medicales = $request->info_medicals;

        if ($request->file('medical')) {
            $file = $request->file('medical');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/enfant/'), $filename);
            $data['document_certificat_medical'] = $filename;
        }
        $data->statut = 'Actif';
        $data->class_enfant_id = $request->classe;
        $data->date_debut = $request->date_debut;
        $data->telephone = $request->telephone;
        $data->save();
        class_enfants::where('id', $request->classe)
          ->decrement('place_disponible', 1);
        $notification = array(
            'message' => ' Informations du Enfant ajoutées avec succès',
            'alert-type' => 'success'
        );


         return redirect()->route('abmenfant.add', ['id_enfant' => $data->id])->with($notification);


    }
    public function Enfantinformation($id){
        $enfant = Enfant::find($id);
         $lastAbn = AbonnementEnfant::where('enfant_id', $enfant->id)
        ->orderByDesc('date_fin')
        ->first();

        $isActive = false;
        // dd($lastAbn);

        if ($lastAbn) {
            // اشتراك ساري إذا تاريخ النهاية اليوم أو بعده (وتقدر تزيد شرط etat إذا تحب)
            $isActive = Carbon::parse($lastAbn->date_fin)->endOfDay()->gte(Carbon::now());
            // إذا تحب تعتمد على etat كذلك:
            // $isActive = ($lastAbn->etat == 1) && Carbon::parse($lastAbn->date_fin)->endOfDay()->gte(Carbon::now());
        }
        return view('admin.enfant.enfant_information', compact('enfant','isActive', 'lastAbn'));
    }
    public function EnfantInscription($id){
        $enfant = Enfant::find($id);
         $crecheInfo = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
            'email' => "aliwameriem@gmail.com"
        ];

        $pdf = Pdf::loadView('admin.enfant.attestation', compact('enfant', 'crecheInfo'))
              ->setPaper('A4', 'portrait');

         // 4. تحميل/عرض PDF
         return $pdf->stream('attestation-inscription.pdf');
    }
    public function genererCarte($id){
        $crecheInfo = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
            'email' => "aliwameriem@gmail.com"
        ];
        $enfant = Enfant::find($id);
        if (!$enfant->code_barre) {
            $enfant->codebarre = 'ENF-' . strtoupper(uniqid());
            $enfant->save();
        }

        $pdf = Pdf::loadView('admin.enfant.carte_enfant', compact('enfant','crecheInfo'))
              ->setPaper([0, 0, 242.65, 153.06], 'portrait'); // Taille carte d'identité standard en points (72 points = 1 pouce)

         // 4. تحميل/عرض PDF
         return $pdf->stream("carte_{$enfant->id}.pdf");

    }
    public function EnfantAbonnement($id){
        $abonnementEnfant = AbonnementEnfant::where('enfant_id', $id)->get();
        $enfant = Enfant::find($id);
        $lastAbn = AbonnementEnfant::where('enfant_id', $enfant->id)
        ->orderByDesc('date_fin')
        ->first();

        $isActive = false;
        // dd($lastAbn);

        if ($lastAbn) {
            // اشتراك ساري إذا تاريخ النهاية اليوم أو بعده (وتقدر تزيد شرط etat إذا تحب)
            $isActive = Carbon::parse($lastAbn->date_fin)->endOfDay()->gte(Carbon::now());
            // إذا تحب تعتمد على etat كذلك:
            // $isActive = ($lastAbn->etat == 1) && Carbon::parse($lastAbn->date_fin)->endOfDay()->gte(Carbon::now());
        }
        // dd($abonnementEnfant);
        return view('admin.enfant.enfant_abonnement', compact('abonnementEnfant','enfant','isActive', 'lastAbn'));
    }


    public function EnfantImpression(){
        $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];

        $enfants = Enfant::all();
        $total = $enfants->count();
        $anneeScolaire = date('Y') . "/" . (date('Y') + 1);
        $pdf = Pdf::loadView('admin.enfant.enfant_impression', compact('enfants','creche','total','anneeScolaire'))
         ->setPaper('a4', 'portrait');

        return $pdf->stream('liste_enfants.pdf');
    }


}
