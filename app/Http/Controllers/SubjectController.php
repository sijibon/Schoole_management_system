<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Toastr;
class SubjectController extends Controller
{
    /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
     $subjects = Subject::orderBy('id','desc')->get();
     return view('setup.students_subject.subject-index', compact('subjects'));
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
     return view('setup.students_subject.subject-create');
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
         'subject_name'=>'required|unique:subjects,subject_name',
     ]);

     $data = new Subject();
     $data->subject_name = $request->subject_name;

     if($data->save() > 0){
         Toastr::success('Subject successfuly inserted', 'Success');
         return redirect()->route('subject.index');
     }else{
         Toastr::error('Subject did not inserted', 'Error');
         return redirect()->route('subject.index');
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
     $editSubject = Subject::where('id',$id)->first();
     return view('setup.students_subject.subject-edit', compact('editSubject'));
 }


 public function update(Request $request, $id)
 {
    $request->validate([
        'subject_name'=>'required|unique:subjects,subject_name',
    ]);

     $data = Subject::find($id);
     $data->subject_name = $request->subject_name;
     if($data->update() > 0){
         Toastr::success('subject successfuly updated', 'Success');
         return redirect()->route('subject.index');
     }else{
         Toastr::error('subject did not updated', 'Error');
         return redirect()->route('subject.index');
     }
 }

 //end

}