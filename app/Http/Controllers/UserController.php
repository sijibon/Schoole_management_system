<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Toastr;
use Hash;
class UserController extends Controller
{
    public function index()
    {
       $users = User::orderBy('id','desc')->get();
       return view('users.user-index', compact('users'));

    }

    public function create()
    {
        return view('users.user-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_role' =>'required',
            'name' =>'required',
            'email' =>'required|unique:users,email',
            'password' =>'required',
            'cpassword' =>'required',
        ]);

        $data = new User();
        $data->user_role = $request->user_role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);

        if($data->save() > 0){
            Toastr::success('User inserted Successfully','Success');
            return redirect()->route('users.view');
        }else{
            Toastr::error('User did not inserted','Error');
            return redirect()->route('users.view');
        }
    }

    public function edit($id)
    {
        $editUser = User::where('id',$id)->first();
        return view('users.user-edit', compact('editUser'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_role' =>'required',
            'name' =>'required',
            'email' =>'required|unique:users,email',
        ]);

        $data = User::findOrFail($id);
        $data->user_role = $request->user_role;
        $data->name = $request->name;
        $data->email = $request->email;
       
        if($data->update() > 0){
            Toastr::success('User updated Successfully','Success');
            return redirect()->route('users.view');
        }else{
            Toastr::success('User updated Successfully','Error');
            return redirect()->route('users.view');
        }
    }

    public function delete($id)
    {
     $delete = User::findOrFail($id);
        if(file_exists('public/upload/user_img/'.$delete->image) AND ! empty($delete->image)){
            unlink('public/upload/user_img/'.$delete->image);
        }

        if($delete->delete() > 0){
            Toastr::success('User deleted Successfully','Success');
            return redirect()->route('users.view');
        }else{
            Toastr::success('User deleted Successfully','Error');
            return redirect()->route('users.view');
        }
}

    
 //end   
}
