<?php

namespace App\Http\Controllers\backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\Enfant;
use App\Models\Enfant\Pere;


class PereController extends Controller
{
    public function PereAdd($enfant_id){

        $enfant_id = $enfant_id;
        $enfant = Enfant::find($enfant_id);

        return view('admin.enfant.pere.pere_add', compact('enfant','enfant_id'));
    }
    public function PereStore(Request $request){

        $enfant_id = $request->enfant_id;
       $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'num1' => 'required',
            'num2' => 'required',
            'email' => 'required',
            'profession' => 'required',
            'adresse' => 'required',
            'piece_identite' => 'required',
            'autorisation' => 'required',
        ]);
        $data = new Pere();
        $data->nom = $request->nom;
        $data->prenom = $request->prenom;
        $data->numero1 = $request->num1;
        $data->numero2 = $request->num2;
        $data->email = $request->email;
        $data->profession = $request->profession;
        $data->adresse = $request->adresse;
        if($request->file('piece_identite')){
            $file = $request->file('piece_identite');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/enfant/pere/'),$filename);
            $data['document_piece_identite'] = $filename;
        }
        if($request->file('autorisation')){
            $file = $request->file('autorisation');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/enfant/pere/'),$filename);
            $data['document_autorisation'] = $filename;
        }
        $data->save();

        $enfant = Enfant::find($enfant_id);
        $enfant->pere_id = $data->id;
        $enfant->save();
        $notification = array(
            'message' => ' Informations du Pére ajoutées avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('enfant.information',$enfant->id)->with($notification);
    }
}
