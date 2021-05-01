<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Toastr;

class AssignSubjectController extends Controller
{
    public function index()
    {
         $assign_subjects = AssignSubject::orderBy('id','desc')->select('class_id')->groupBy('class_id')->get();
          return view('setup.assign_subject.assignSubject-index', compact('assign_subjects'));
    }


    public function create()
    {   
        $all_class = StudentClass::get();
        $subjects = Subject::get();
        return view('setup.assign_subject.assignSubject-create', compact('all_class','subjects'));
    }


    public function store(Request $request)
    {
        $subjectCount = count($request->subject_id);
        $sub_assign = new AssignSubject();
       
        for ($i = 0; $i < $subjectCount; $i++) {
            $data[] = [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id[$i],
                'full_mark' => $request->full_mark[$i],
                'pass_mark' => $request->pass_mark[$i],
                'subjective_mark' => $request->subjective_mark[$i],
            ];
        }

        AssignSubject::insert($data);
        Toastr::success('subject assign successfuly inserted', 'Success');
        return redirect()->route('assignSubject.index');
    }

       
    public function show($class_id)
    {
        $show = AssignSubject::with('class')->where('class_id',$class_id)->orderBy('class_id','asc')->get();
        return view('setup.assign_subject.show-assign-subject', compact('show'));
    }



    public function edit($class_id)
    {
     $assignSubjects = AssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        $all_class = StudentClass::get();
        $subjects = Subject::get();
        return view('setup.assign_subject.assignSubject-edit', compact('assignSubjects','subjects','all_class'));
    }


    public function update(Request $request, $class_id)
    {
    
        if($request->subject_id == null){
            Toastr::error('You did not select any class', 'Error');
            return redirect()->route('assignSubject.edit');
        }else{
            $subjectCount = count($request->subject_id);
            $updateData = AssignSubject::where('class_id',$class_id)->delete();
            for ($i = 0; $i < $subjectCount; $i++) {
                $data[] = [
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id[$i],
                    'full_mark' => $request->full_mark[$i],
                    'pass_mark' => $request->pass_mark[$i],
                    'subjective_mark' => $request->subjective_mark[$i],
                ];
            }

        }
      
        AssignSubject::insert($data);
        Toastr::success('Subject Assign successfuly updated', 'Success');
        return redirect()->route('assignSubject.index');
 }


 //end
}