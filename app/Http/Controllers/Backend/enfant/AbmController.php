<?php

namespace App\Http\Controllers\Backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\Abonnement;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class AbmController extends Controller
{

    public function AbonnementView(){

        $data['allData'] = Abonnement::all();
        return view('admin.enfant.abonnement.abonnement_view', $data);
    }

    public function AbonnementAdd(){
        return view('admin.enfant.abonnement.abonnement_add');
    }

    public function AbonnementStore(Request $request){
        $validatedData = $request->validate([
            'titre' => 'required',
            'prix' => 'required',
            'description' => 'required',

            'type' => 'required',
            'frais_inscription' => 'nullable|numeric',
            'frais_livres' => 'nullable|numeric',


        ]);

        $data = new Abonnement();
        $data->titre = $request->titre;
        $data->duree_jours = $request->jour;
        $data->type = $request->type;

        $data->description = $request->description;
        $data->prix = $request->prix;
        $data->frais_inscription = $request->frais_inscription;
        $data->frais_livres = $request->frais_livres;
        $data->save();

        $notification = array(
            'message' => " Abonnement ajouté avec succès",
            'alert-type' => 'success'
        );
        return redirect()->route('abonnement.view')->with($notification);
    }
    public function AbonnementImpression(){
         $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];
        $abonnements = Abonnement::all();
        $total = $abonnements->count();
        $anneeScolaire = date('Y') . "/" . (date('Y') + 1);



        $pdf = Pdf::loadView('admin.enfant.abonnement.abonnement_impression', compact('abonnements','creche', 'total', 'anneeScolaire'))
              ->setPaper('a4', 'portrait');

        return $pdf->stream('liste_abonnements.pdf');
    }
}
