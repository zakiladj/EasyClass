<?php

namespace App\Http\Controllers\Backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Enfant\employes;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class EmployesController extends Controller
{

    public function EmployesView(){

        $data['allData'] = employes::all();
        // dd($data['allData']);
        return view('admin.enfant.employes.employes_view', $data);
    }

    public function EmployesAdd(){
        return view('admin.enfant.employes.employes_add');
    }
    public function EmployesStore(Request $request){

        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'num1' => 'required',
            'salaire' => 'required',
            'niveau' => 'required',
            'date_embauche' => 'required',

        ]);
        // dd($request->all());
        $data = new employes();
        $data->nom = $request->nom;
        $data->prenom = $request->prenom;
        $data->email = $request->email;
        $data->telephone = $request->num1;
        $data->telephone2 = $request->num2;
        $data->poste = $request->poste;
        $data->salaire = $request->salaire;
        $data->niveau = $request->niveau;
        $data->date_embauche = $request->date_embauche;
        $data->address = $request->adresse;

        if ($request->file('document_piece_identite')) {
            $file = $request->file('document_piece_identite');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/enfant/employes/'), $filename);
            $data['document_piece_identite'] = $filename;

        }

        if ($request->file('diplome')) {
            $file = $request->file('diplome');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/enfant/employes/'), $filename);
            $data['diplome'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Employé Inséré Avec Succès',
            'alert-type' => 'success'
        );

        return redirect()->route('employes.view')->with($notification);
    }
    public function EmployesImpression(){
            $creche = [
                'name' => "Crèche Ali Wa Meriem",
                'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
                'phone1' => "0658718913",
                'phone2' => "0659841210",
                'email' => "aliwameriem@gmail.com"
            ];

            $employes = employes::all();
            $total = $employes->count();
           $anneeScolaire = date('Y') . "/" . (date('Y') + 1);

            $pdf = Pdf::loadView('admin.enfant.employes.impression', compact('employes','creche', 'total', 'anneeScolaire'))
              ->setPaper('a4', 'portrait');

            return $pdf->stream('liste_employes.pdf');

        // return view('admin.enfant.pdf.employes_impression', compact('allData'));
    }

    public function Employesinformation($id){
        $data['employes'] = employes::find($id);
        // dd( $data['employes']);
        return view('admin.enfant.employes.employes_information', $data);
    }

    public function EmployesAttestation($id){
        $employe = employes::find($id);

        $crecheInfo = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
            'email' => "aliwameriem@gmail.com"
        ];
            $date = Carbon::now()->locale('fr')->translatedFormat('d F Y');
            $attestation_no = sprintf('AT-%s-%s', date('Ymd'), $employe->id);

            $pdf = Pdf::loadView(
                'admin.enfant.employes.attestation_travail',
                compact('employe', 'crecheInfo', 'date', 'attestation_no')
            )->setPaper('A4', 'portrait');

          return $pdf->stream("attestation-travail-{$employe->id}.pdf");
    }
    public function EmployesCarte($id){

        $employes = employes::find($id);

        $crecheInfo = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
            'email' => "aliwameriem@gmail.com"
        ];

        if (!$employes->code_barre) {
            $employes->code_barre = 'ENF-' . strtoupper(uniqid());
            $employes->save();
        }
        $pdf = Pdf::loadView('admin.enfant.employes.carte_employe', compact('employes','crecheInfo'))
              ->setPaper([0, 0, 242.65, 153.06], 'portrait');
        return $pdf->stream("carte_employe_{$employes->id}.pdf");
    }



}
