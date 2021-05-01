<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Toastr;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::orderBy('id','desc')->get();
        return view('setup.designation.designation-index', compact('designations'));
    }


    public function create()
    {
        return view('setup.designation.designation-create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'desig_name'=>'required|unique:designations,desig_name',
        ]);

        $data = new Designation();
        $data->desig_name = $request->desig_name;

        if($data->save() > 0){
            Toastr::success('Designation successfuly inserted', 'Success');
            return redirect()->route('designation.index');
        }else{
            Toastr::error('Designation did not inserted', 'Error');
            return view('setup.designation.designation-index');
        }
    }

    public function show(StudentClass $studentClass)
    {
        //
    }

  
    public function edit($id)
    {
        $desigEdit = Designation::where('id',$id)->first();
        return view('setup.designation.designation-edit', compact('desigEdit'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'desig_name'=>'required|unique:designations,desig_name',
        ]);

        $data = Designation::find($id);
        $data->desig_name = $request->desig_name;
        if($data->update() > 0){
            Toastr::success('Designation successfuly updated', 'Success');
            return redirect()->route('designation.index');
        }else{
            Toastr::error('Designation did not updated', 'Error');
            return redirect()->route('designation.index');
        }
    }

}
