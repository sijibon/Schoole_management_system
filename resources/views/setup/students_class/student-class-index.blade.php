
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
        <h1 class="m-0">Class List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Students Class</li>
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
              <h3 class="card-title">Class List</h3>
              <a href="{{route('class.create')}}" class="btn btn-sm btn-success float-right"><i class="fa fa-plus-circle"></i> Add Class</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>              
                        <th>#SL</th>
                        <th>Class Name</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @php
                    $key =1;
                @endphp
                <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$class->class_name}}</td>                          
                            <td class="d-flex">
                                <a class="btn btn-sm btn-info mx-1" href="{{ url('student/class/'.$class->id.'/edit') }}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('class.destroy', $class->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="delete" title="delete" style="border: none; background-color:transparent;">
                                      <a class="btn btn-sm btn-danger" href="{{url('student/class'.$class->id)}}"><i class="far fa-trash-alt"></i></a>
                                    </button>
                                </form>
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
@endpush

@endsection