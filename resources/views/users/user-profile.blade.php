@extends('layouts.backend.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 offset-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{(!empty($user->image)) ? url('public/upload/user_img/'.$user->image): url('public/upload/default_img.png')}}"
                         alt="User profile picture">
                  </div>
  
                  <h3 class="profile-username text-center">{{$user->name}}</h3>
                  <h4 class="text-muted text-center"><span class="badge badge-success">{{$user->user_role}}</span></h4>
  
                  <table width="100%" class="table">
                      <tr>
                          <td>Name</td>
                          <td>{{$user->name}}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{$user->phone}}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{$user->gender}}</td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>{{$user->user_role}}</td>
                    </tr>
                    <tr>
                        <td>Adress</td>
                        <td>{{$user->address}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{$user->status}}</td>
                    </tr>
                  </table>
  
                  <a href="{{url('profiles/edit/'.$user->id)}}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </div>
      </div>
    </div>
</section>

@endsection