<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use Toastr;
class FeeCategoryController extends Controller
{
    public function index()
    {
        $fees = FeeCategory::orderBy('id','desc')->get();
        return view('students_fee.fee-index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students_fee.fee-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fee_name'=>'required|unique:fee_categories,fee_name',
        ]);

        $data = new FeeCategory();
        $data->fee_name = $request->fee_name;
        if($data->save() > 0){
            Toastr::success('Fee successfuly inserted', 'Success');
            return redirect()->route('fee.index');
        }else{
            Toastr::error('Fee did not inserted', 'Error');
            return view('students_fee.fee-index');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editFee = FeeCategory::where('id',$id)->first();
        return view('students_fee.fee-edit', compact('editFee'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'fee_name'=>'required|unique:fee_categories,fee_name',
        ]);

        $data = FeeCategory::find($id);
        $data->fee_name = $request->fee_name;
        if($data->update() > 0){
            Toastr::success('Fee successfuly updated', 'Success');
            return redirect()->route('fee.index');
        }else{
            Toastr::error('Fee did not updated', 'Error');
            return redirect()->route('fee.index');
   
       }
    }
}
