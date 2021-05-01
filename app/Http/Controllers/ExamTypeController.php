<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;
use Toastr;
class ExamTypeController extends Controller
{
    public function index()
    {
        $exam_types = ExamType::orderBy('id','desc')->get();
        return view('setup.exam_type.examType-index', compact('exam_types'));
    }


    public function create()
    {
        return view('setup.exam_type.examType-create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'exam_name'=>'required|unique:exam_types,exam_name',
        ]);

        $data = new ExamType();
        $data->exam_name = $request->exam_name;
        if($data->save() > 0){
            Toastr::success('Exam successfuly inserted', 'Success');
            return redirect()->route('examType.index');
        }else{
            Toastr::error('Exam did not inserted', 'Error');
            return redirect()->route('examType.index');
        }
    }


    public function show(StudentClass $studentClass)
    {
        //
    }


    public function edit($id)
    {
        $exam_edit = ExamType::where('id',$id)->first();
        return view('setup.exam_type.examType-edit', compact('exam_edit'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_name'=>'required|unique:exam_types,exam_name',
        ]);

        $data = ExamType::find($id);
        $data->exam_name = $request->exam_name;
        if($data->update() > 0){
            Toastr::success('Exam successfuly updated', 'Success');
            return redirect()->route('examType.index');
        }else{
            Toastr::error('Exam did not updated', 'Error');
            return redirect()->route('examType.index');
   
       }
    }
}
