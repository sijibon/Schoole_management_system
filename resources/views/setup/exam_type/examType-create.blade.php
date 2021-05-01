@extends('layouts.backend.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Exam Type Manage</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Exam Type List</li>
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
                  <h3 class="card-title">Add Exam</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form action="{{ route('examType.store')}}" method="post" id="quickForm"> 
                  @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label>Exam Name</label>
                              <input type="text" name="exam_name" class="form-control" placeholder="Exam Name ...">
                              <font style="color: red">{{($errors->has('exam_name'))? ($errors->first('exam_name')): ''}}</font>
                            </div>
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
          exam_name: {
            required: true,
            exam_name: true,
          },
         
        },
        messages: {
          exam_name: {
            required: "Please enter exam type name",
            exam_name: "Please enter a unique exam name"
          },
          terms: "Please accept our terms"
          
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