<?php

namespace App\Http\Controllers\Backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\Fournisseur;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FournisseurController extends Controller
{

    public function FournisseurView(){


        $data['allData'] = Fournisseur::all();
        // dd($data['allData']);
        return view('admin.enfant.fournisseur.fournisseur_view', $data);
    }
    public function FournisseurAdd(){
          return view('admin.enfant.fournisseur.fournisseur_add');
    }
    public function FournisseurStore(Request $request){
        $request->validate([
        'nom'         => 'required|string|max:255',
        'sociale'     => 'required|string|max:255',
        'phone1'      => 'required|string|max:20',
        'type'        => 'required|in:personne,entreprise,autre',
        'address'     => 'required|string',
        'categorie'   => 'required|string|max:255',
         ]);

         Fournisseur::create([
            'nom_commercial'=> $request->nom,
            'raison_sociale'=> $request->sociale,
            'telephone'=> $request->phone1,
            'telephone_secondaire'=> $request->phone2,
            'type' => $request->type,
            'email'=> $request->email,
            'adresse'=> $request->address,
            'banque'=> $request->banque,
            'rib'=> $request->rip,
            'baridimob'=> $request->baradi_mob,
            'categorie'=> $request->categorie,
            'note'=> $request->note,

    ]);


        $notification = array(
            'message' => 'Fournisseur Inséré avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('fournisseur.view')->with($notification);

    }
}
