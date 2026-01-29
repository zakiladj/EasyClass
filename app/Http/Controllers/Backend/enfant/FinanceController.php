<?php

namespace App\Http\Controllers\Backend\enfant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfant\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class FinanceController extends Controller
{


   public function FinanceView(){

        $data['allData'] = Category::all();
        // dd($data['allData']);
        return view('admin.enfant.finance.finance_view', $data);
   }
    public function FinanceAdd(){
          return view('admin.enfant.finance.finance_add');
    }

    public function FinanceStore(Request $request){
        $validatedData = $request->validate([
            'nom' => 'required',
            'type' => 'required',

        ]);
        // dd($request->all());
        $data = new Category();
        $data->name = $request->nom;
        $data->type = $request->type;
        $data->note = $request->note;
        $data->is_active = 1;
        $data->save();
        $notification = array(
            'message' => 'Catégorie Insérée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('finance.view')->with($notification);

    }

    public function FinanceImpression(){
         $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];
        $categories = Category::all();
        $total = $categories->count();
        $anneeScolaire = date('Y') . "/" . (date('Y') + 1);

        $pdf = Pdf::loadView('admin.enfant.finance.finance_impression', compact('creche', 'categories', 'total', 'anneeScolaire'))->setPaper('a4', 'portrait');
        return $pdf->stream('categorie_financiere.pdf');
    }


}
