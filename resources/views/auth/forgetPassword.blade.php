<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password</title>

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
      <b>Reset Password</b>
    </div>

    <div class="card-body">

      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      @if (Session::has('message'))
      <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
      </div>
      @endif

      <form action="{{ route('forget.password.post') }}" method="POST">
      @csrf
      
      @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
      @endif
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email_address">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
          </div>
        </div>
      </form>
      
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js"></script>
</body>
</html>
