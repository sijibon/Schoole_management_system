<?php

namespace App\Http\Controllers;

use App\Models\FeeAmount;
use App\Models\StudentClass;
use App\Models\FeeCategory;
use Illuminate\Http\Request;
use Toastr;

class FeeAmountController extends Controller
{
    public function index()
    {

        $fee_amounts = FeeAmount::with('fee_category')->orderBy('id','desc')->select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('fee_amount.fee_amount-index', compact('fee_amounts'));
    }


    public function create()
    {   
        $all_class = StudentClass::get();
        $FeeCategory = FeeCategory::get();
        return view('fee_amount.fee_amount-create', compact('all_class','FeeCategory'));
    }



    public function store(Request $request)
    {
        $classCount = count($request->class_id);
        $fee_amount = new FeeAmount();
       
        for ($i = 0; $i < $classCount; $i++) {
            $data[] = [
                'fee_category_id' => $request->fee_category_id,
                'class_id' => $request->class_id[$i],
                'amount' => $request->amount[$i]
            ];
        }

        FeeAmount::insert($data);
        Toastr::success('Amount successfuly inserted', 'Success');
        return redirect()->route('fee_amount.index');
    }

       
    public function show($fee_category_id)
    {
        $show = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('fee_amount.fee_amount_show', compact('show'));
    }



    public function edit($fee_category_id)
    {
     $fee_amount_edits = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $all_class = StudentClass::get();
        $FeeCategory = FeeCategory::get();
        return view('fee_amount.fee_amount-edit', compact('fee_amount_edits','FeeCategory','all_class'));
    }


    public function update(Request $request, $fee_category_id)
    {
    
        if($request->class_id == null){
            Toastr::error('You did not select any class', 'Error');
            return redirect()->route('fee_amount.edit');
        }else{
            $classCount = count($request->class_id);
            $updateData = FeeAmount::where('fee_category_id',$fee_category_id)->delete();
            for ($i = 0; $i < $classCount; $i++) {
                $data[] = [
                    'fee_category_id' => $request->fee_category_id,
                    'class_id' => $request->class_id[$i],
                    'amount' => $request->amount[$i]
                ];
            }

        }
      
        FeeAmount::insert($data);
        Toastr::success('Amount successfuly updated', 'Success');
        return redirect()->route('fee_amount.index');
 }


 //end
}