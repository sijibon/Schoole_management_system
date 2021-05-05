@extends('layouts.backend.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Vendor</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active">Vendor</li>
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
                  <h3 class="card-title">Create User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form action="{{route('users.store')}}" method="post" id="quickForm">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>User Role</label>
                            <select name="user_role" class="custom-select form-control" id="user_role">
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>

                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name ...">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email ...">
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
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#quickForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          name: {
            required: true,
            name: true,
          },
          user_role: {
            required: true,
          },
          // password: {
          //   required: true,
          //   minlength: 6
          // },

          // cpassword: {
          //   required: true,
          //   equalTo:'#password',
          // },
          terms: {
            required: true
          },
        },
        messages: {

          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          name: {
            required: "Please enter name",
         
          },
          user_role: {
            required: "Please select one",
          },
          // password: {
          //   required: "Please provide a password",
          //   minlength: "Your password must be at least 6 characters long"
          // },
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