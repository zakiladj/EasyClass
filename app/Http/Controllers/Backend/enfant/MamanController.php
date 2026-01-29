<?php

namespace App\Http\Controllers\backend\enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\Enfant;
use App\Models\Enfant\Maman;

class MamanController extends Controller
{
    public function MamanAdd($enfant_id){
        $enfant_id = $enfant_id;
        $enfant = Enfant::find($enfant_id);
        return view('admin.enfant.maman.maman_add', compact('enfant','enfant_id'));
    }
    public function MamanStore(Request $request){

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
        $data = new Maman();
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
            $file->move(public_path('upload/enfant/maman/'),$filename);
            $data['document_piece_identite'] = $filename;
        }
        if($request->file('autorisation')){
            $file = $request->file('autorisation');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/enfant/maman/'),$filename);
            $data['document_autorisation'] = $filename;
        }
        $data->save();
        $enfant = Enfant::find($enfant_id);
        $enfant->maman_id = $data->id;
        $enfant->save();
        $notification = array(
            'message' => ' Informations du Maman ajoutées avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('enfant.information',$enfant->id)->with($notification);
    }
}
