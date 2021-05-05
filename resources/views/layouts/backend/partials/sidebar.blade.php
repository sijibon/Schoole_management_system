 @php
     $prefix = Request::Route()->getPrefix();
     $route = Route::current()->getName();
 @endphp


  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('public/assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">C.P.H.School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{(!empty(Auth::user()->image))? url('public/upload/user_img/'.Auth::user()->image): url('public/upload/default_img.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('profiles.view')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{Request::is('home') ? 'active':''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
          </li>
          @if(Auth::user()->user_role == 'Admin')
          <li class="nav-item {{($prefix =='users') ? 'menu-open': ''}}">
            <a href="#" class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="nav-icon fas fa-th"></i>
              <p>User Manage</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.view')}}" class="nav-link {{($route =='users.view') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item {{Request::is('profiles')? 'menu-open': ''}}">
            <a href="#" class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="nav-icon fa fa-user"></i>
              <p>Profile Manage</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profiles.view')}}" class="nav-link {{Request::is('profiles/view') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('profiles.cpassword')}}" class="nav-link {{Request::is('profiles/cpassword') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Password Change</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{Request::is('setup') ? 'menu-open': ''}}">
            <a href="#" class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="nav-icon fa fa-file"></i>
              <p>Management Setup</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('class.index')}}" class="nav-link {{Request::is('student/class') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Students Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('year.index')}}" class="nav-link {{Request::is('student/year') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Year</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('group.index')}}" class="nav-link {{Request::is('student/group') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('shift.index')}}" class="nav-link {{Request::is('student/shift') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Shift</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('fee.index')}}" class="nav-link {{Request::is('student/fee') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('fee_amount.index')}}" class="nav-link {{Request::is('student/fee_amount') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fee Category Amount</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('examType.index')}}" class="nav-link {{Request::is('student/examType') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('subject.index')}}" class="nav-link {{Request::is('student/subject') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subjects View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('assignSubject.index')}}" class="nav-link {{Request::is('student/assignSubject') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('designation.index')}}" class="nav-link {{Request::is('student/designation') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Designations</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{Request::is('student/registration') ? 'menu-open': ''}}">
            <a href="#" class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="nav-icon fa fa-user"></i>
              <p>Student Manage</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('registration.index')}}" class="nav-link {{Request::is('student/registration') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('roll_generate.index')}}" class="nav-link {{Request::is('student/roll_generate') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roll Generate</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>