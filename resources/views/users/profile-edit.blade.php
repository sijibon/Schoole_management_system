@extends('layouts.backend.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
                  <h3 class="card-title">Edit User-Profile</h3>
                  <a href="{{route('profiles.view')}}" class="btn btn-sm btn-success float-right"> <i class="fa fa-user"></i> Profile</a>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                <form action="{{route('profiles.update',$editData->id)}}" method="post" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" class="form-control" value="{{$editData->name}}" placeholder="Name ...">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" value="{{$editData->email}}" class="form-control" placeholder="Email ...">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" name="phone" value="{{$editData->phone}}" class="form-control" placeholder="phone ...">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" name="address" value="{{$editData->address}}" class="form-control" placeholder="address ...">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Image</label>
                          <input type="file" name="image" id="image" value="{{$editData->image}}" class="form-control">
                        </div>
                        <img id="showImg" src="{{(!empty($editData->image)) ? url('public/upload/user_img'.$editData->image): url('public/upload/default_img.png')}}" style="height: 100px; width:150px" alt="">
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="custom-select form-control" id="user_role">
                                <option value="Male" {{($editData->gender =='Male')? 'selected':''}}>Male</option>
                                <option value="Female" {{($editData->gender =='Female')? 'selected':''}}>Female</option>
                                <option value="Others" {{($editData->gender =='Others')? 'selected':''}}>Others</option>
                            </select>
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
          password: {
            required: true,
            minlength: 6
          },

          cpassword: {
            required: true,
            equalTo:'#password',
          },
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
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
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