<?php

namespace App\Http\Controllers\Backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\class_enfants;
use App\Models\Enfant\employes;
use App\Models\Enfant\Enfant;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ClassesController extends Controller
{

    public function ClassesView(){

        $data['allData'] = class_enfants::all();
        // dd($data['allData']);
        return view('admin.enfant.classes.classes_view', $data);
    }
    public function ClassesAdd(){
        $educatrice = employes::where('poste', 'educatrice')->get();
        return view('admin.enfant.classes.classes_add', compact('educatrice'));
    }
    public function ClassesStore(Request $request){

        $validatedData = $request->validate([
            'classe' => 'required',
            'niveau' => 'required',
            'capacite' => 'required',
            'educatrice' => 'required',
            'description' => 'required',
            'annee' => 'required',


        ]);
        // dd($request->all());
        $annee = date('Y', strtotime($request->annee));
        $data = new class_enfants();
        $data->nom = $request->classe;
        $data->niveau = $request->niveau;
        $data->capacite = $request->capacite;
        $data->prof_id = $request->educatrice;
        $data->description = $request->description;
        $data->annee = $annee;
        $data->save();
        $notification = array(
            'message' => 'Classe  Insérée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('classes.view')->with($notification);

    }
    public function ClassesEnfant($id){

        // $data['enfants'] = Enfant::find($id)->enfants;
        $class = class_enfants::find($id);

        $data  = Enfant::where('class_enfant_id', $id)->get();
        // dd($data);

        return view('admin.enfant.classes.classes_enfant', compact('data','class'));
        // return view('admin.enfant.classes.classes_enfant', compact('data'));
        // $data['class'] = class_enfants::find($id);

        // return view('admin.enfant.classes.classes_enfant', $data);
    }

        Public function ClassesInformation($id){

            $data['class'] = class_enfants::find($id);
            return view('admin.enfant.classes.classes_information', $data);
        }

    public function ClassesImpression($id){

       $classe = class_enfants::findOrFail($id);

        // مهم جداً لدعم اللغة العربية
        $crecheInfo = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
            'email' => "aliwameriem@gmail.com"
        ];
        PDF::setOptions(['defaultFont' => 'DejaVu Sans']);

        // $pdf = PDF::loadView('admin.enfant.pdf.classes', compact('classe'))
        //           ->setPaper('A4', 'portrait');
        $pdf = PDF::loadView('admin.enfant.pdf.classes', [
                'classe'     => $classe,
                'crecheInfo' => $crecheInfo
            ])->setPaper('A4', 'portrait');

        return $pdf->stream("class_{$classe->id}.pdf");
    }

    public function ClassesImpressionEnfant($id){

       $classe = class_enfants::findOrFail($id);
       $enfants = Enfant::where('class_enfant_id', $id)->get();

        // مهم جداً لدعم اللغة العربية
        $crecheInfo = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
            'email' => "aliwameriem@gmail.com"
        ];
        PDF::setOptions(['defaultFont' => 'DejaVu Sans']);
        $pdf = PDF::loadView('admin.enfant.pdf.classes_enfant', [
                'class'     => $classe,
                'enfants'    => $enfants,
                'crecheInfo' => $crecheInfo
            ])->setPaper('A4', 'portrait');
        return $pdf->stream("class_enfants_{$classe->id}.pdf");
    }


}
