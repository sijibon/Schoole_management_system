
@extends('layouts.backend.app')
@section('content')

@push('css')
<link rel="stylesheet" href="{{asset('public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Manage Student Registration</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Students Registration</li>
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
              <h3 class="card-title">Students List</h3>
              <a href="{{route('registration.create')}}" class="btn btn-sm btn-success float-right"><i class="fa fa-plus-circle"></i> Add Student</a>
            </div>
            <div class="card-body">
             <form action="{{route('yearSearch')}}" method="GET" id="myForm">
              <div class="form-row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Class</label>
                      <select name="class_id" id="" class="form-control">
                        <option value="">Select Class</option>
                          @foreach ($classes as $class)
                          <option value="{{$class->id}}" {{(@$class_id == $class->id)? "selected":""}}>{{$class->class_name}}</option>                                      
                          @endforeach
                      </select>
                    <font style="color: red">{{($errors->has('class_id'))? ($errors->first('class_id')): ''}}</font>
                  </div>
              </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <label>Year</label>
                        <select name="year" id="" class="form-control">
                        <option value="">Select Year</option>
                            @foreach ($years as $year)
                            <option value="{{$year->id}}" {{(@$year_id == $year->id)? "selected":""}}>{{$year->year_name}}</option>                                       
                            @endforeach
                        </select>
                      <font style="color: red">{{($errors->has('year'))? ($errors->first('year')): ''}}</font>
                    </div>
                </div>
                <div class="col-sm-4">
                  <button class="btn btn-sm btn-success" name="search" style="margin-top: 30px">Search</button>
                <div>
              </div>   
            </form>          
            </div>

            <div class="card-body">
              @if (!@$search)
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>              
                        <th width="7%">#SL</th>
                        <th>Name</th>
                        <th>ID No.</th>
                        <th>Roll No.</th>
                        <th>Class</th>
                        <th>Year</th>
                        @if (Auth::user()->user_role == "Admin")
                        <th>Code</th>
                        @endif
                        <th>Image</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>

                @php
                    $key =1;
                @endphp
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$student->user->name}}</td>                          
                            <td>{{$student->user->id_no}}</td>                          
                            <td>{{$student->roll}}</td>                          
                            <td>{{$student->class->class_name}}</td>                          
                            <td>{{$student->year->year_name}}</td> 
                            @if (Auth::user()->user_role == "Admin")
                            <td>{{$student->user->code}}</td>
                            @endif                         
                            <td>
                              <img
                              src="{{(!empty($student->user->image)) ? url('public/upload/student_images/'.$student->user->image): url('public/upload/default_img.png')}}"
                              alt=" picture" style="height: 60px;witdh:100px">
                            </td>                          
                            <td class="d-flex">
                                <a class="btn btn-sm btn-info mx-1" title="Edit" href="{{ url('student/registration/'.$student->student_id.'/edit') }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-success mx-1" title="Promotion" href="{{ url('student/promotion/'.$student->student_id) }}"><i class="fas fa-check"></i></a>
                                <a class="btn btn-sm btn-success mx-1" target="_blank" title="Details" href="{{ url('student/details/'.$student->student_id) }}"><i class="fas fa-eye"></i></a>

                            </td>
                        </tr>
                    @endforeach
               <tbody>
              </table>
              @else
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>              
                        <th width="7%">#SL</th>
                        <th>Name</th>
                        <th>ID No.</th>
                        <th>Roll No.</th>
                        <th>Class</th>
                        <th>Year</th>
                        @if (Auth::user()->user_role == "Admin")
                        <td>Code</td>
                        @endif 
                        <th>Image</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>

                  @php
                      $key =1;
                  @endphp
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$student->user->name}}</td>                          
                            <td>{{$student->user->id_no}}</td>                          
                            <td>{{$student->roll}}</td>                          
                            <td>{{$student->class->class_name}}</td>                          
                            <td>{{$student->year->year_name}}</td>   
                            @if (Auth::user()->user_role == "Admin")
                            <td>{{$student->user->code}}</td>
                            @endif                        
                            <td>
                              <img
                              src="{{(!empty($student->user->image)) ? url('public/upload/student_images/'.$student->user->image): url('public/upload/default_img.png')}}"
                              alt=" picture" style="height: 60px;witdh:100px">
                            </td>                          
                            <td class="d-flex">
                              <a class="btn btn-sm btn-info mx-1" title="Edit" href="{{ url('student/registration/'.$student->student_id.'/edit') }}"><i class="fas fa-edit"></i></a>
                              <a class="btn btn-sm btn-success mx-1" title="Promotion" href="{{ url('student/promotion/'.$student->student_id) }}"><i class="fas fa-check"></i></a>
                              <a class="btn btn-sm btn-success mx-1" target="_blank" title="Details" href="{{ url('student/details/'.$student->student_id) }}"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
               <tbody>
              </table>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@push('js')
<script src="{{asset('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
  $(function () {
    $('#myForm').validate({
      rules: {
        class_id: {
          required: true,
        },
        year: {
          required: true,
        },
       
      },

      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
@endpush

@endsection