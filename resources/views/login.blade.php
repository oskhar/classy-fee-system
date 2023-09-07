<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Log in SMK Triguna Utama</title>
    <link rel="shortcut icon" href="{{ asset('images/smk3gu0ke.png') }}" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    {{-- <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    /> --}}
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}"
    />
    <!-- icheck bootstrap -->
    <link
      rel="stylesheet"
      href="{{ asset('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}" />
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>SMK</b> TRIGUNA UTAMA</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body row justify-content-center">
          <div class="col-sm-6 my-3">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid">
          </div>

          <form action="{{ route('dashboard') }}" method="get" class="col-sm-11">
            <div class="input-group mb-3">
              <select class='form-control' id='id_jurusan' name='id_jurusan'>
                  <option value='' selected disabled>Pilih Satu Opsi</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Pembayaran SPP">Pembayaran SPP</option>
                  <option value="E-Raport">E-Raport</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember"> Remember Me </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mb-3">
            <p class="mb-1 text-left">
              <a href="forgot-password.html">I forgot my password</a>
            </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>
  </body>
</html>
