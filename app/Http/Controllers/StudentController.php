<?php

namespace App\Http\Controllers;

use App\Models\backend\students\Student;
use App\Models\backend\students\Discount;
use App\Models\User;
use App\Models\StudentGroup;
use App\Models\StudentClass;
use App\Models\Shift;
use App\Models\Year;
use App\Models\FeeCategory;
use DB;
use Toastr;
use Hash;
use PDF;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::get();
        $data['year_id'] = Year::orderBy('id','desc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id','asc')->first()->id;
        $data['students'] = Student::where('year_id', $data['year_id'])->where('class_id',$data['class_id'])->get();
        return view('layouts.backend.student_reg.student_reg-index', $data);
    }


    public function create()
    {
        $groups = StudentGroup::get();
        $classes = StudentClass::get();
        $shifts = Shift::get();
        $years = Year::get();
        $fee_category = FeeCategory::get();
        return view('layouts.backend.student_reg.student_reg-create', compact('groups','classes','years','shifts','fee_category'));
    }


    public function store(Request $request)
    {
    DB::transaction(function() use($request){
        $checkYear = Year::find($request->year)->year_name;
        $student = User::where('user_type','student')->orderBy('id','desc')->first();

        if($student == null){
            $firstReg = 0;
            $studentId = $firstReg+1;
            if($studentId < 10){
                $stu_id = "000".$studentId;
            }
            elseif($studentId < 100){
                $stu_id = "00".$studentId;
            }
            elseif($studentId < 1000){
                $stu_id = "0".$studentId;
            }
        }else{
        $student = User::where('user_type','student')->orderBy('id','desc')->first()->id;
        $studentId = $student + 1;
        if($studentId < 10){
            $stu_id = "000".$studentId;
        }
        elseif($studentId < 100){
            $stu_id = "00".$studentId;
        }
        elseif($studentId < 1000){
            $stu_id = "0".$studentId;
        }
        }
        $final_id_no = $checkYear.$stu_id;
        $user = new User();
        $user->id_no = $final_id_no;
        $code = rand(0000,9999);
        $user->code = $code;
        $user->password = Hash::make($code);
        $user->name = $request->student_name;
        $user->email = $request->email;
        $user->fname = $request->fname;
        $user->user_type = "student";
        $user->mname = $request->mname;
        $user->phone = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
        $user->save();

        $assignStudent = new Student();
        $assignStudent->student_id = $user->id;
        $assignStudent->year_id =  $request->year;
        $assignStudent->class_id = $request->class_id;
        $assignStudent->group_id = $request->group;
        $assignStudent->shift_id = $request->shift;
        $assignStudent->save();

        $discountStudent = new Discount();
        $discountStudent->student_id = $assignStudent->id;
        $discountStudent->fee_category_id = $request->fee_category;
        $discountStudent->discount = $request->discount;
        $discountStudent->save();

        });  
        Toastr::success('Registration successfuly inserted', 'Success');
        return redirect()->route('registration.index');
    }


    public function yearSearch(Request $request)
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::get();
        $data['year_id'] = $request->year;
        $data['class_id'] = $request->class_id;
        $data['students'] = Student::where('year_id', $request->year)->where('class_id',$request->class_id)->get();
        return view('layouts.backend.student_reg.student_reg-index', $data);
    }

    public function edit($student_id)
    {
        $data['editData'] = Student::with('user')->where('student_id',$student_id)->first();
        $data['groups'] = StudentGroup::get();
        $data['classes'] = StudentClass::get();
        $data['shifts'] = Shift::get();
        $data['years'] = Year::get();
        $data['fee_category'] = FeeCategory::get();
        return view('layouts.backend.student_reg.student_reg-edit', $data);
    }


    public function update(Request $request, $student_id)
    {
        $user = User::where('id',$student_id)->first();
        $user->name = $request->student_name;
        $user->email = $request->email;
        $user->fname = $request->fname;
        $user->user_type = "student";
        $user->mname = $request->mname;
        $user->phone = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
        $user->save();

        $assignStudent = Student::where('id',$request->id)->where('student_id',$student_id)->first();
        $assignStudent->year_id =  $request->year;
        $assignStudent->class_id = $request->class_id;
        $assignStudent->group_id = $request->group;
        $assignStudent->shift_id = $request->shift;
        $assignStudent->save();

        $discountStudent = Discount::where('student_id',$request->id)->first();
        $discountStudent->fee_category_id = $request->fee_category;
        $discountStudent->discount = $request->discount;
        $discountStudent->save();
        Toastr::success('Registraion successfuly updated', 'Success');
        return redirect()->route('registration.index');

    }



    public function promotion($student_id)
    {
        $data['editData'] = Student::with('user')->where('student_id',$student_id)->first();
        $data['groups'] = StudentGroup::get();
        $data['classes'] = StudentClass::get();
        $data['shifts'] = Shift::get();
        $data['years'] = Year::get();
        $data['fee_category'] = FeeCategory::get();
        return view('layouts.backend.student_reg.promotion', $data);
    }


    public function promotionStore(Request $request, $student_id)
    {
        $user = User::where('id',$student_id)->first();
        $user->name = $request->student_name;
        $user->email = $request->email;
        $user->fname = $request->fname;
        $user->user_type = "student";
        $user->mname = $request->mname;
        $user->phone = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->dob = date('d-m-Y',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
        $user->save();

        $assignStudent = new Student();
        $assignStudent->student_id = $student_id;
        $assignStudent->year_id =  $request->year;
        $assignStudent->class_id = $request->class_id;
        $assignStudent->group_id = $request->group;
        $assignStudent->shift_id = $request->shift;
        $assignStudent->save();

        $discountStudent = new Discount();
        $discountStudent->student_id = $assignStudent->id;
        $discountStudent->fee_category_id = $request->fee_category;
        $discountStudent->discount = $request->discount;
        $discountStudent->save();
        Toastr::success('Registraion successfuly updated', 'Success');
        return redirect()->route('registration.index');
    }


    public function details($student_id)
    {
        $data['details'] = Student::with('user')->where('student_id',$student_id)->first();
        $pdf = PDF::loadView('layouts.backend.student_reg.reg-invoice', $data);
        $pdf->setOptions(['copy', 'print'], '', 'pass');
        return $pdf->stream('invoice.pdf');
    }


}
