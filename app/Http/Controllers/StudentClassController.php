<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use Toastr;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = StudentClass::orderBy('id','desc')->get();
        return view('setup.students_class.student-class-index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setup.students_class.class-create');
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
            'class_name'=>'required|unique:student_classes,class_name',
        ]);

        $data = new StudentClass();
        $data->class_name = $request->class_name;

        if($data->save() > 0){
            Toastr::success('Class successfuly inserted', 'Success');
            return redirect()->route('class.index');
        }else{
            Toastr::error('Class did not inserted', 'Error');
            return view('setup.students_class.student-class-index');
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
        $edit = StudentClass::where('id',$id)->first();
        return view('setup.students_class.edit-class', compact('edit'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name'=>'required|unique:student_classes,class_name',
        ]);

        $data = StudentClass::find($id);
        $data->class_name = $request->class_name;
        if($data->update() > 0){
            Toastr::success('Class successfuly updated', 'Success');
            return redirect()->route('class.index');
        }else{
            Toastr::error('Class did not updated', 'Error');
            return redirect()->route('class.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = StudentClass::where('id',$id)->delete();
        Toastr::success('Class successfuly deleted', 'Success');
        return redirect()->route('class.index');

    }
}
