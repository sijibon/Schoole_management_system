@extends('layouts.backend.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change Password</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item active">Password Change</li>
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
        <div class="col-md-11">
            <!-- general form elements disabled -->
            <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form action="{{route('profiles.change.password')}}" method="post" id="quickForm">
            @csrf
            <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" id="password" class="form-control" placeholder="Current Password ...">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password ...">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Confirme Password</label>
                        <input type="password" name="confirme_password" class="form-control" placeholder="Confirm Password ...">
                    </div>
                </div> 
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
                </form>
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
            current_password: {
            required: true,
          },
          new_password: {
            required: true,
            minlength: 6
          },
          confirme_password: {
            required: true,
            equalTo:'#new_password'
          },
        },
        messages: {
          current_password: {
            required: "Please provide current password",
          },
          new_password: {
            required: "Please provide a new password",
            minlength: "Please provide at least 6 character",
          },
          
          confirme_password: {
            required: "Please provide again password",
            equalTo: "Confirme password doesnt match"
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