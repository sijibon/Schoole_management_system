<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Toastr;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
       $id = Auth::user()->id;
       $user = User::find($id);
       return view('users.user-profile', compact('user'));
    }

    public function edit()
    {
       $id = Auth::user()->id;
       $editData = User::find($id);
       return view('users.profile-edit',compact('editData'));
    }

    public function update(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->gender = $request->gender;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_img/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_img/'), $filename);
            $data['image'] = $filename;
        }
       
        if($data->update() > 0){
            Toastr::success('Profile updated Successfully','Success');
            return redirect()->route('profiles.view');
        }else{
            Toastr::error('Did not uploaded','Error');
            return redirect()->route('profiles.view');
        }
    }


    public function cpassword()
    {
        return view('users.edit-password');
    }

    public function changePassword(Request $request)
    {
       if(Auth::attempt(['id'=>Auth::user()->id, 'password'=> $request->current_password])){
           $user = User::find(Auth::user()->id);
           $user->password = Hash::make($request->new_password);
           
           if($user->save()){
            Toastr::success('Password has been changed','Success');
            return redirect()->route('profiles.cpassword');
        }else{
            Toastr::error('Did not marched password','Error');
            return redirect()->back();
        }
    }

}
//end
}

