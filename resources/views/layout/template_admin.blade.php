<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/smk3gu0ke.png') }}" type="image/x-icon">
  <title>@yield('title')</title>
  @include('depedensi.layout.template_admin');
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed bg-light">
{{-- @include('components.loading') --}}
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" id="navbar-costume">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route("dashboard") }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- sidebar logo -->
    <a href="{{ url('') }}" class="brand-link mb-4">
      <img src="{{ asset('images/smk3gu0ke.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SMK Triguna Utama</span>
    </a>
    <!-- ./sidebar logo -->

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-0">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- li-main-dashboard -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->is('admin')) active @endif">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Main Dashboard
              </p>
            </a>
          </li>
          <!-- ./li-main-dashboard -->

          <!-- li-menu-data-siswa -->
          <li class="nav-item">
            <a href="{{ route('admin.data_siswa') }}" class="nav-link @if(strpos(request()->path(), 'admin/data-siswa') !== false) active @endif">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <!-- li-menu-data-siswa -->

          <!-- li-menu-data-pembayaran-spp -->
          <li class="nav-item">
            <a href="?page=pembayaran-spp" class="nav-link">
              <i class="nav-icon fas fa-money-check-dollar"></i>
              <p>Data Pembayaran SPP</p>
            </a>
          </li>
          <!-- li-menu-data-pembayaran-spp -->

          <!-- li-menu-cetak-laporan -->
          <li class="nav-item">
            <a href="?page=cetak-laporan" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>Cetak Laporan</p>
            </a>
          </li>
          <!-- /. li-menu-cetak-laporan -->

          <!-- menu-pengaturan-sistem -->
          <li class="nav-item @if(strpos(request()->path(), 'admin/data-jurusan') !== false || strpos(request()->path(), 'admin/data-kelas') !== false || strpos(request()->path(), 'admin/data-tahun-ajar') !== false) menu-open @endif">

            <!-- pengaturan sistem -->
            <a href="#" class="nav-link @if(strpos(request()->path(), 'admin/data-jurusan') !== false || strpos(request()->path(), 'admin/data-kelas') !== false || strpos(request()->path(), 'admin/data-tahun-ajar') !== false) active @endif">
              <i class="nav-icon fas fa-gears"></i>
              <p>Pengaturan Sistem<i class="fas fa-angle-left right"></i></p>
            </a>
            <!-- /. pengaturan sistem -->

            <!-- nav-tree-pengaturan-sistem -->
            <ul class="nav nav-treeview">

              <!-- data jurusan -->
              <li class="nav-item">
                <a href="{{ route('admin.data_jurusan') }}" class="nav-link @if(strpos(request()->path(), 'admin/data-jurusan') !== false) active @endif">
                  <i class="fas fa-minus nav-icon"></i>
                  <p>Data Jurusan</p>
                </a>
              </li>
              <!-- /.data jurusan -->

              <!-- data kelas -->
              <li class="nav-item">
                <a href="{{ route('admin.data_kelas') }}" class="nav-link @if(strpos(request()->path(), 'admin/data-kelas') !== false) active @endif">
                  <i class="fas fa-minus nav-icon"></i>
                  <p>Data kelas</p>
                </a>
              </li>
              <!-- ./data kelas -->

              <!-- data tahun ajar -->
              <li class="nav-item">
                <a href="{{ route('admin.data_tahun_ajar') }}" class="nav-link @if(strpos(request()->path(), 'admin/data-tahun-ajar') !== false) active @endif">
                  <i class="fas fa-minus nav-icon"></i>
                  <p>Data Tahun Ajar</p>
                </a>
              </li>
              <!-- ./data tahun ajar -->

              <!-- data jenis pembayaran -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-minus nav-icon"></i>
                  <p>Data Jenis Pembayaran</p>
                </a>
              </li>
              <!-- ./data jenis pembayaran -->

            </ul>
            <!-- nav-tree-pengaturan-sistem -->

          </li>
          <!-- ./menu-pengaturan-sistem -->

          <!-- li-keluar -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sign-out"></i>
              <p>Keluar</p>
            </a>
          </li>
          <!-- /. li-keluar -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper mt-5">
    @yield('mainContent')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
</html>
