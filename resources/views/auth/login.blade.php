<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Log in SMK Triguna Utama</title>
    <link rel="shortcut icon" href="{{ asset('images/smk3gu0ke.png') }}" type="image/x-icon">
    @include('depedensi.auth.login')
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

          <form class="col-sm-11" id="form-login">
            <div class="input-group mb-3">
              <select class='form-control' id='jenis_login' name='jenis_login'>
                  <option value='' selected disabled>Pilih Satu Opsi</option>
                  <option value="admin">Administrator</option>
                  <option value="Pembayaran SPP">Pembayaran SPP</option>
                  <option value="E-Raport">E-Raport</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username / Email" id="username" required/>
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
                id="password"
                required
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
  </body>
</html>
