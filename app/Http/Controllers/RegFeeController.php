<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Year;
use App\Models\FeeAmount;
use App\Models\backend\students\Student;
use Toastr;
use DB;
use PDF;
class RegFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::get();
        return view('layouts.backend.registration_fee.reg-fee-index', $data);
        
    }

    public function get_student(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if($year_id != ''){
            $where[] = ['year_id','like',$year_id.'%'];
        }

        if($class_id != ''){
            $where[] = ['class_id','like',$class_id.'%'];
        }

        $allstudent = Student::with('discount','user')->where($where)->get();
        // dd($allstudent);

        $html['thsource'] = '<th>#SL</th>';
        $html['thsource'] .= '<th>ID No.</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No.</th>';
        $html['thsource'] .= '<th>Registration Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th> Fee (This student)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach($allstudent as $key => $value){
            $reg_fee = FeeAmount::where('fee_category_id','2')->where('class_id',$value->class_id)->first();
            // dd($reg_fee);
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['user']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$reg_fee->amount.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['discount']['discount'].'%'.'</td>';

            $original_fee = $reg_fee->amount;
            $discount = $value['discount']['discount'];
            $discountable_fee = $original_fee/100*$discount;
            $final_fee = (int)$original_fee - (int)$discountable_fee;
            // dd($final_fee);

            $html[$key]['tdsource'] .= '<td>'.$final_fee.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PlaySlip" target="_blank" 
            href="'.route("student.reg.fee.slip").'?class_id='.$value->class_id.'&student_id='.$value->student_id.'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '<td>';
        }

        return response()->json(@$html);
   
    }


    public function paySlip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $allstudent['details'] = Student::with(['discount','user'])->where('student_id', $student_id)->where('class_id',$class_id)->first();
        $pdf = PDF::loadView('layouts.backend.registration_fee.reg-fee-slip', $allstudent);
        $pdf->setOptions(['copy', 'print'], '', 'pass');
        return $pdf->stream('invoice.pdf');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class_id = $request->class_id;
        $year_id = $request->year_id;

        if($request->student_id != null){
            for($i = 0; $i < count($request->student_id); $i++){
               Student::where('year_id',$year_id)->where('class_id', $class_id)->where('student_id',$request->student_id[$i])
               ->update(['roll'=>$request->roll[$i]]);
        }

    }else{
        Toastr::error('There are no Students', 'Error');
        return redirect()->back();
    }
    Toastr::success('Roll successfully generated', 'Success');
    return redirect()->route('roll_generate.index');

}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}