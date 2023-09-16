<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/smk3gu0ke.png') }}" type="image/x-icon">
  <title>AdminLTE 3 | Top Navigation</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  @include('depedensi.layout.template_siswa')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
    <div class="container">
      <!-- Logo di kiri -->
      <a href="{{ route('siswa.home') }}" class="navbar-brand">
        <img src="{{ asset('images/smk3gu0ke.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMK Triguna Utama</span>
      </a>

      <!-- Tombol Collapse di kanan dengan ml-auto -->
      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="{{ route('siswa.home') }}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswa.pembayaran_spp') }}" class="nav-link">Pembayaran SPP</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswa.e-raport') }}" class="nav-link">E-Raport</a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('mainContent')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
</body>
</html>
