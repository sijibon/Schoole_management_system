
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
        <h1 class="m-0">Manage Fee Category Amount</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Fee Amount</li>
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
              <h3 class="card-title">Fee List</h3>
              <a href="{{route('fee_amount.index')}}" class="btn btn-sm btn-success float-right"><i class="fa fa-list"></i> Fee Amount List</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>              
                        <th>#SL</th>
                        <th>Fee Category </th>
                        <th>Class Name </th>
                        <th>Amount </th>
                    </tr>
                </thead>

                @php
                 $key =1;
                @endphp
                <tbody>
                    @foreach ($show as $view)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$view->fee_category->fee_name}}</td>   
                            <td>{{$view->studentClass->class_name}}</td>                          
                            <td>{{$view->amount}}</td>                         
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