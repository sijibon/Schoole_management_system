
@extends('layouts.backend.app')

@section('content')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">User List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Datalist</h3>
              <a href="{{route('users.create')}}" class="btn btn-sm btn-success float-right"><i class="fa fa-plus-circle"></i> User Add</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>              
                        <th>#SL</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @php
                    $key =1;
                @endphp
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$user->name}}</td>
                            <td><span class="badge badge-success">{{$user->user_role}}</span></td>
                            <td>{{$user->email}}</td>
                            <td class="d-flex">
                                <a class="btn btn-sm btn-info mc-1" href="{{ url('users/edit/'.$user->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-success mx-1" href="{{ url('users/view/'.$user->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-danger" id="delete" href="{{ url('users/delete/'.$user->id) }}"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
               <tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection