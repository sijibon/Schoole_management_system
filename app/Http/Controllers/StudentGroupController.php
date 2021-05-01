<?php

namespace App\Http\Controllers;

use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Toastr;

class StudentGroupController extends Controller
{
    public function index()
    {
        $groups = StudentGroup::orderBy('id','desc')->get();
        return view('setup.students_group.group-index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setup.students_group.group-create');
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
            'group_name'=>'required|unique:student_groups,group_name',
        ]);

        $data = new StudentGroup();
        $data->group_name = $request->group_name;
        if($data->save() > 0){
            Toastr::success('Group successfuly inserted', 'Success');
            return redirect()->route('group.index');
        }else{
            Toastr::error('Group did not inserted', 'Error');
            return view('setup.students_group.group-index');
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
        $editGroup = StudentGroup::where('id',$id)->first();
        return view('setup.students_group.edit-group', compact('editGroup'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'group_name'=>'required|unique:student_groups,group_name',
        ]);

        $data = StudentGroup::find($id);
        $data->group_name = $request->group_name;
        if($data->update() > 0){
            Toastr::success('Year successfuly updated', 'Success');
            return redirect()->route('group.index');
        }else{
            Toastr::error('Year did not updated', 'Error');
            return redirect()->route('group.index');
        }
    }

}
