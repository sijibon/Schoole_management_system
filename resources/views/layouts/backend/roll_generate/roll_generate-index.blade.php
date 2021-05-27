
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
        <h1 class="m-0">Roll Generate</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Students Roll</li>
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
              <h3 class="card-title">Students Roll List</h3>
            </div>
            <div class="card-body">
            <form action="{{route('roll.store')}}" method="POST" id="myForm">
             @csrf
            <div class="form-row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Class</label>
                      <select name="class_id" id="class_id" class="form-control">
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
                        <select name="year_id" id="year_id" class="form-control">
                        <option value="">Select Year</option>
                            @foreach ($years as $year)
                            <option value="{{$year->id}}">{{$year->year_name}}</option>                                       
                            @endforeach
                        </select>
                      <font style="color: red">{{($errors->has('year'))? ($errors->first('year')): ''}}</font>
                    </div>
                </div>
                <div class="col-sm-4">
                  <a id="search" class="search btn btn-sm btn-success" name="search" style="margin-top: 30px">Search</a>
                <div>
              </div><br> 
            </div>
              <div class="row">
               <div class="d-none col-md-12" id="roll_generate">
                <table  class="table table-bordered table-hover dt-responsive" style="width: 100%">
                    <thead>
                        <tr>              
                            <th>ID No.</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Year</th>
                            <th>Roll No.</th>
                        </tr>
                    </thead>
                    <tbody id="roll_generate_tr">

                    </tbody>
                </table>
              </div>
              <button type="submit" class="btn btn-sm btn-success ml-3">Roll Generate</button>
            </div>
            </form>          
            </div>
            <div class="card-body">

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
        year_id: {
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#search').on('click',function(){
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();

        $.ajax({
            url: "{{ route('get.student')}}",
            type: "GET",
            data: {class_id:class_id, year_id: year_id},
            success: function(data){
                $('#roll_generate').removeClass('d-none');
                var html = '';
                $.each(data, function(key, v){
                    html += 
                    '<tr>'+ 
                        '<td>'+v.user.id_no +'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                        '<td>'+v.user.name +'</td>'+
                        '<td>'+v.user.fname +'</td>'+
                        '<td>'+v.user.gender +'</td>'+
                        '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
                    '</tr>';
                });
                
                html = $('#roll_generate_tr').html(html);
            }
        });
            
        });
    });
</script>
@endpush

@endsection