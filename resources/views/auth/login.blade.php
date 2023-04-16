<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/lte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/lte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <b>Login Page</b>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      @error('loginError')
        <div class="alert alert-danger">
            <strong>Error</strong>
            <p>{{ $message }}</p>
        </div>
      @enderror

      <form method="post">
        @csrf

        @error('email')
            <small style="color: red">{{$message}}</small>
        @enderror

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="email">
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
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          @error('g-recaptcha-response')
            <small style="color: red">{{$message}}</small>
          @enderror
          {!! NoCaptcha::display() !!}
          {!! NoCaptcha::renderJs() !!}
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block mb-2">Sign In</button>
          </div>
        </div>
      </form>

      <div class="row">
        <div class="col-12 text-center">
            <a href="/register" style="text-decoration: underline;">Register Here</a>
        </div>
        <div class="col-12 text-center">
            <a href="/forget-password" style="text-decoration: underline;">I forgot my password ?</a>
        </div>
      </div>


    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js"></script>
</body>
</html>
