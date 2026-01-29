<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeAmount;
use App\Models\StudentYear;
use App\Models\StudentFee;


class FeeAmountController extends Controller
{
    //
    public function AmountView(){
        $data['allData'] = FeeAmount::all();
        return view('backend.setup.fee_amounts.view_fee_amount',$data);

    }
}
