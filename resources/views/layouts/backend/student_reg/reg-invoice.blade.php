<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Details</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/assets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <style>
      table{
          border-collapse: collapse;
      }
      h3, h5, h6{
          margin:0px;
          padding:0px;
      }
      .table{
          width: 100%;
          margin-bottom: 1rem;
          background-color: transparent;
      }
      table tr td{
          padding: 5px;
      }
  </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table width="80%">
                <tr>
                    <td width="33%" style="text-align: center"><img src="{{url('public/upload/default_img.png')}}" alt="" style="height:100%; width:100%"></td>
                    <td width="63%" style="text-align: center">
                        <h3><strong>Chhagalnaiya Govt. Pilot School</strong></h3>
                        <h5>Chhagalnaiya, Feni</h5>
                        <h6>www.chhagalnaiygovt.highschool</h6>
                    </td>
                    <td width="33%" style="text-align: center">
                        <img src="{{url('public/upload/student_images/'.$details->user->image)}}" alt=" picture" style="height:100;witdh:100%">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <h4 style="font-weight: bold; padding-top:-25px; text-align:center">Student Registration Details</h4>
        </div>
        <div class="col-md-12">
            <table width="100%" border="1">
                <tbody>
                    <tr>
                        <td width="30%">Name</td>
                        <td>{{$details->user->name}}</td>
                    </tr>
                    <tr>
                        <td>Father's Name</td>
                        <td>{{$details->user->fname}}</td>
                    </tr>
                    <tr>
                        <td>Session</td>
                        <td>{{$details->year->year_name}}</td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>{{$details->class->class_name}}</td>
                    </tr>
                    <tr>
                        <td>ID No</td>
                        <td>{{$details->user->id_no}}</td>
                    </tr>
                    <tr>
                        <td>Roll No</td>
                        <td>{{$details->user->roll_no}}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{$details->user->phone}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{$details->user->address}}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{$details->user->gender}}</td>
                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td>{{$details->user->religion}}</td>
                    </tr>
                    <tr>
                        <td>Date of birth</td>
                        <td>{{$details->user->dob}}</td>
                    </tr>
                </tbody>
            </table>
            <i style="font-size: 12px; float: left;">Print Date: {{date("d-m-Y")}}</i>
        </div>
    </div><br>
    <div class="col-md-12">
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td style="width: 30%"></td>
                    <td style="width: 30%"></td>
                    <td style="width: 40%; text-align:center">
                        <hr style="border:solid 0.3px; width:60%; color:black; margin-bottom:0px"> 
                        <p style="text-align:center; margin-top:0px">Principle/Headmaster</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
