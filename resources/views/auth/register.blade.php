<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/lte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/lte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  
<div class="register-box">
  <div class="card card-outline card-primary">

    <div class="card-header text-center">
      <b>Register Page</b>
    </div>

    <div class="card-body">
      <p class="login-box-msg">Register a new user</p>

      @error('loginError')
        <div class="alert alert-danger">
            <strong>Error</strong>
            <p>{{ $message }}</p>
        </div>
      @enderror

      <form action="{{ route('authenticatedRegister') }}" method="post" enctype="multipart/form-data">
        @csrf

        @error('name')
            <small style="color: red">{{$message}}</small>
        @enderror

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Name" id="name" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        @error('email')
            <small style="color: red">{{$message}}</small>
        @enderror

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        @error('password')
            <small style="color: red">{{$message}}</small>
        @enderror

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        @error('password')
          <small style="color: red">{{$message}}</small>
        @enderror     

        <div class="input-group mb-3">
          <input id="password_confirmation" type="password" class="form-control" placeholder="Password Confirm" name="password_confirmation">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
            </div>
        </div>   

        <div class="row">
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>

      <div class="row">
        <div class = "col-12 text-center">
          <a href="/login" class="text-center" style="text-decoration: underline;">Already have an account ?</a>
        </div>    
      </div>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js"></script>
</body>
</html>
