<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Year;
use App\Models\backend\students\Student;
use Toastr;


class RollGenerateController extends Controller
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
        return view('layouts.backend.roll_generate.roll_generate-index', $data);
        
    }

    public function get_student(Request $request)
    {
       $get_student = Student::with(['user','year','class'])->where('class_id', $request->class_id)->where('year_id',$request->year_id)->get();
       return response()->json($get_student);
   
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
