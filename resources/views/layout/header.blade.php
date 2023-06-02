<header class="main-header">
    <!-- Logo -->
    <a href="{{asset('/adminlte')}}/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>POS</b>APP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="{{asset('/adminlte')}}/#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="{{asset('/adminlte')}}/#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('/adminlte')}}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"> {{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('/adminlte')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  {{auth()->user()->name}} Web Developer
                 
                </p>
              </li>
              <!-- Menu Body -->
              {{-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="{{asset('/adminlte')}}/#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="{{asset('/adminlte')}}/#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="{{asset('/adminlte')}}/#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li> --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{asset('/adminlte')}}/#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#"  class="btn btn-default btn-flat" onclick="$('#logout-app').submit()">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>

  <form action="{{route('logout')}}" method="post" id="logout-app" style="display: none;">
    @csrf
  </form>