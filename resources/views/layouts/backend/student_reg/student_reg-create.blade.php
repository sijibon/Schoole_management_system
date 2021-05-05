@extends('layouts.backend.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Registration Manage</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Students List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Add Student</h3>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('registration.store')}}" method="post" id="quickForm"  enctype="multipart/form-data"> 
                  @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Student Name</label>
                              <input type="text" name="student_name" class="form-control" placeholder="Student Name ...">
                              <font style="color: red">{{($errors->has('student_name'))? ($errors->first('student_name')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email ...">
                          </div>
                       </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Father's Name</label>
                              <input type="text" name="fname" class="form-control" placeholder="Father Name ...">
                              <font style="color: red">{{($errors->has('fname'))? ($errors->first('fname')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Mother's Name</label>
                              <input type="text" name="mname" class="form-control" placeholder="Mother Name ...">
                              <font style="color: red">{{($errors->has('mname'))? ($errors->first('mname')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Mobile</label>
                              <input type="number" name="mobile" class="form-control" placeholder="Mobile ...">
                              <font style="color: red">{{($errors->has('mobile'))? ($errors->first('mobile')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Address</label>
                              <input type="text" name="address" class="form-control" placeholder="Address ...">
                              <font style="color: red">{{($errors->has('address'))? ($errors->first('address')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Gender</label>
                                <select name="gender" id="" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>
                              <font style="color: red">{{($errors->has('gender'))? ($errors->first('gender')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Religion</label>
                                <select name="religion" id="" class="form-control">
                                  <option value="">Select Religion</option>
                                    <option value="islam">Islam</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="khristian">Khristian</option>
                                </select>
                              <font style="color: red">{{($errors->has('gender'))? ($errors->first('gender')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Date of Birth</label>
                              <input type="date" name="dob" class="form-control singledatepicker" autocomplete="off">
                              <font style="color: red">{{($errors->has('dob'))? ($errors->first('dob')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Discount</label>
                              <input type="text" name="discount" class="form-control" placeholder="Discount ..">
                              <font style="color: red">{{($errors->has('discount'))? ($errors->first('discount')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Class</label>
                                <select name="class_id" id="" class="form-control">
                                  <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                    <option value="{{$class->id}}">{{$class->class_name}}</option>                                      
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
                                    <option value="{{$year->id}}">{{$year->year_name}}</option>                                       
                                    @endforeach
                                </select>
                              <font style="color: red">{{($errors->has('year'))? ($errors->first('year')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Group</label>
                                <select name="group" id="" class="form-control">
                                  <option value="">Select Group</option>
                                    @foreach ($groups as $group)
                                    <option value="{{$group->id}}">{{$group->group_name}}</option>                                      
                                    @endforeach
                                </select>
                              <font style="color: red">{{($errors->has('group'))? ($errors->first('group')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Fee Category</label>
                                <select name="fee_category" id="" class="form-control">
                                  <option value="">Select Fee Category</option>
                                    @foreach ($fee_category as $category)
                                    <option value="{{$category->id}}">{{$category->fee_name}}</option>                                      
                                    @endforeach
                                </select>
                              <font style="color: red">{{($errors->has('fee_category'))? ($errors->first('fee_category')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Shift</label>
                                <select name="shift" id="" class="form-control">
                                  <option value="">Select Shift</option>
                                    @foreach ($shifts as $shift)
                                    <option value="{{$shift->id}}">{{$shift->shift_name}}</option>                                      
                                    @endforeach
                                </select>
                              <font style="color: red">{{($errors->has('shift'))? ($errors->first('shift')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" name="image" id="image" value="" class="form-control">
                            </div>
                            <img id="showImg" src="{{ url('public/upload/default_img.png')}}" style="height: 100px; width:120px" alt="">
                        </div>
                        <div class="col-sm-6 mt-4 p-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </div>
                  </form>
                 </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

  @push('js')
  <script src="{{asset('public/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('public/assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script>
    $(function () {
      $('#quickForm').validate({
        rules: {
          student_name: {
            required: true,
          },
          email: {
            required: true,
          },
          fname: {
            required: true,
          },
         mname: {
            required: true,

          },
          mobile: {
            required: true,

          },
          address: {
            required: true,
          },
          gender: {
            required: true,
          },
          religion: {
            required: true,
          },
          dob: {
            required: true,

          },

          class_id: {
            required: true,

          },
          year: {
            required: true,
          },

          fee_category: {
            required: true,
          },
          image: {
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
  @endpush
@endsection