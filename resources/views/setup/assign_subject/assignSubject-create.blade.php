@extends('layouts.backend.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Fee Amount Manage</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Fee Amount List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Fee Amount</h3>
            </div>
            <div class="card-body">
            <form action="{{ route('assignSubject.store')}}" method="post" id="quickForm" enctype="multipart/form-data"> 
            @csrf
                <div class="add_item">
                    <div class="form-row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Class Name</label>
                                <select name="class_id" class="form-control">
                                    <option value="">Select Class Name</option>
                                    @foreach ($all_class as $item)
                                    <option value="{{$item->id}}">{{$item->class_name}}</option>
                                    @endforeach
                                </select>
                                <font style="color: red">{{($errors->has('class_id'))? ($errors->first('class_id')): ''}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Subject Name</label>
                                <select name="subject_id[]" class="form-control">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $item)
                                    <option value="{{$item->id}}">{{$item->subject_name}}</option>   
                                    @endforeach
                                </select>
                                <font style="color: red">{{($errors->has('subject_id'))? ($errors->first('subject_id')): ''}}</font>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Full Marks</label>
                                <input type="number" name="full_mark[]" class="form-control" placeholder="Full Mark ...">
                                <font style="color: red">{{($errors->has('full_mark'))? ($errors->first('full_mark')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Pass Mark</label>
                                <input type="number" name="pass_mark[]" class="form-control" placeholder="Pass Mark ...">
                                <font style="color: red">{{($errors->has('pass_mark'))? ($errors->first('pass_mark')): ''}}</font>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Subjective mark</label>
                                <input type="number" name="subjective_mark[]" class="form-control" placeholder="subjective mark ...">
                                <font style="color: red">{{($errors->has('get_mark'))? ($errors->first('get_mark')): ''}}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <span  class="btn btn-sm btn-info" id="addMoreEvent" style="margin-top: 33px"><i class="fa fa-plus-circle"></i></span>
                        </div>
                    </div>
                </div>  
                <div class="col-sm-6 mt-4 p-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>              
            </form>
          </div>
        </div>
     </div> 
 </div>


 {{-- visible part --}}

 <div style="visibility:hidden">
     <div class="whole_extra_item_add" id="whole_extra_item_add">
         <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="form-row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Subject Name</label>
                        <select name="subject_id[]" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach ($subjects as $item)
                            <option value="{{$item->id}}">{{$item->subject_name}}</option>   
                            @endforeach
                        </select>
                        <font style="color: red">{{($errors->has('subject_id'))? ($errors->first('subject_id')): ''}}</font>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Full Marks</label>
                        <input type="number" name="full_mark[]" class="form-control" placeholder="Full Mark ...">
                        <font style="color: red">{{($errors->has('full_mark'))? ($errors->first('full_mark')): ''}}</font>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Pass Mark</label>
                        <input type="number" name="pass_mark[]" class="form-control" placeholder="Pass Mark ...">
                        <font style="color: red">{{($errors->has('pass_mark'))? ($errors->first('pass_mark')): ''}}</font>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Subjective mark</label>
                        <input type="number" name="subjective_mark[]" class="form-control" placeholder="subjective Mark ...">
                        <font style="color: red">{{($errors->has('get_mark'))? ($errors->first('get_mark')): ''}}</font>
                    </div>
                </div>
                <div class="form-group">
                    <span class="btn btn-sm btn-info" id="addMoreEvent" style="margin-top: 33px"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-sm btn-danger" id="deleteMoreEvent" style="margin-top: 33px"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>
         </div>
     </div>
 </div>
</section>
<!-- /.content -->

  @push('js')
  <script src="{{asset('public/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('public/assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>

 <script>
    $(function () {
      $('#quickForm').validate({
        rules: {
            class_id: {
            required: true,
          },
         
          "subject_id[]": {
            required: true,
          },
                   
          "full_mark[]": {
            required: true,
          },
          "pass_mark[]": {
            required: true,
          },
          "subjective_mark[]": {
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
            var counter  = 0;
            $(document).on('click','#addMoreEvent', function(){
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest('.add_item').append(whole_extra_item_add);
                counter++;
            });

            $(document).on('click','#deleteMoreEvent', function(event){
                $(this).closest('#whole_extra_item_delete').remove();
                counter -=1;
            });
        })
    </script>
  @endpush
@endsection