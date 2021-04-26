<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Toastr;
class YearController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = year::orderBy('id','desc')->get();
        return view('students_year.year-index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students_year.year-create');
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
            'year_name'=>'required|unique:years,year_name',
        ]);

        $data = new year();
        $data->year_name = $request->year_name;

        if($data->save() > 0){
            Toastr::success('Year successfuly inserted', 'Success');
            return redirect()->route('year.index');
        }else{
            Toastr::error('Year did not inserted', 'Error');
            return view('students_year.year-index');
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
        $editYear = year::where('id',$id)->first();
        return view('students_year.edit-year', compact('editYear'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'year_name'=>'required|unique:years,year_name',
        ]);

        $data = Year::find($id);
        $data->year_name = $request->year_name;
        if($data->update() > 0){
            Toastr::success('Year successfuly updated', 'Success');
            return redirect()->route('year.index');
        }else{
            Toastr::error('Year did not updated', 'Error');
            return redirect()->route('year.index');
        }
    }


}
