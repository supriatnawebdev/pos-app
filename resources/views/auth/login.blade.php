@extends('layout.auth')
@section('login')
<div class="login-box">
    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo">
            <a href="{{url('/')}}"><b>POS</b>APP</a>
          </div>
  
      <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" placeholder="Email" required> 
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
  
  
    </div>
    <!-- /.login-box-body -->
  </div>

  @endsection