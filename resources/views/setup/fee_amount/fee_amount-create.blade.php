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
            <form action="{{ route('fee_amount.store')}}" method="post" id="quickForm" enctype="multipart/form-data"> 
            @csrf
                <div class="add_item">
                    <div class="form-row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Fee Category</label>
                                <select name="fee_category_id" class="form-control">
                                    <option value="">Select Fee Category</option>
                                    @foreach ($FeeCategory as $item)
                                    <option value="{{$item->id}}">{{$item->fee_name}}</option>
                                    @endforeach
                                </select>
                                <font style="color: red">{{($errors->has('fee_category_id'))? ($errors->first('fee_category_id')): ''}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Class</label>
                                <select name="class_id[]" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach ($all_class as $item)
                                    <option value="{{$item->id}}">{{$item->class_name}}</option>   
                                    @endforeach
                                </select>
                                <font style="color: red">{{($errors->has('class_id'))? ($errors->first('class_id')): ''}}</font>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Fee Amount</label>
                                <input type="number" name="amount[]" class="form-control" placeholder="Fee Amount ...">
                                <font style="color: red">{{($errors->has('amount'))? ($errors->first('amount')): ''}}</font>
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
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Class</label>
                        <select name="class_id[]" class="form-control">
                            <option value="">Select Class</option>
                            @foreach ($all_class as $item)
                            <option value="{{$item->id}}">{{$item->class_name}}</option>   
                            @endforeach
                        </select>
                        <font style="color: red">{{($errors->has('class_id'))? ($errors->first('class_id')): ''}}</font>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Fee Amount</label>
                        <input type="number" name="amount[]" class="form-control" placeholder="Fee Amount ...">
                        <font style="color: red">{{($errors->has('amount'))? ($errors->first('amount')): ''}}</font>
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
            fee_category_id: {
            required: true,
          },
         
          "class_id[]": {
            required: true,
          },
                   
          "amount[]": {
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