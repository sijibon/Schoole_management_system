<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Toastr;
class ShiftController extends Controller
{
   public function index()
    {
        $shifts = Shift::orderBy('id','desc')->get();
        return view('setup.students_shift.shift-index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setup.students_shift.shift-create');
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
            'shift_name'=>'required|unique:shifts,shift_name',
        ]);

        $data = new Shift();
        $data->shift_name = $request->shift_name;
        if($data->save() > 0){
            Toastr::success('Shift successfuly inserted', 'Success');
            return redirect()->route('shift.index');
        }else{
            Toastr::error('Shift did not inserted', 'Error');
            return view('setup.students_shift.shift-index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function show(StudentClass $studentClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editShift = Shift::where('id',$id)->first();
        return view('setup.students_shift.shift-edit', compact('editShift'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'shift_name'=>'required|unique:shifts,shift_name',
        ]);

        $data = Shift::find($id);
        $data->shift_name = $request->shift_name;
        if($data->update() > 0){
            Toastr::success('Shift successfuly updated', 'Success');
            return redirect()->route('shift.index');
        }else{
            Toastr::error('Shift did not updated', 'Error');
            return redirect()->route('shift.index');
   
       }
  }
  
}