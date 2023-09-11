@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')
@include('depedensi.admin.dashboard')
<!-- section-header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Main Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Main Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- /.section-header -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
        <!-- ----------------------------------------------------------------------- -->
        <!-- /. div-welcome -------------------------------------------------------- -->
        <!-- ----------------------------------------------------------------------- -->
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    Selamat Datang Adminstrator, Anda login saat ini tanggal 01 Januari 2023 pukul 07.00 WIB    
                </div>
                <!-- /.div-alert -->     
            </div>
            <!-- /.div-col -->
        </div>
        <!-- /.div-row -->

        <!-- ----------------------------------------------------------------------- -->
        <!-- /. Informasi Umum Aplikasi -------------------------------------------- -->
        <!-- ----------------------------------------------------------------------- -->
        <div class="row mb-4">

            <div class="col-md-12">
                <div class="callout callout-success">
                    <b>Informasi Umum Aplikasi</b>
                </div>
            </div>
            <!-- /.col-md-12-informasi-umum -->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-building-columns"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Jurusan</span>
                        <span class="info-box-number">10</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-jurusan-->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-building-columns"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Kelas</span>
                        <span class="info-box-number">10</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-kelas-->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-user-graduate"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Siswa</span>
                        <span class="info-box-number">1,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-siswa-->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-user-gear"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Adminstrator</span>
                        <span class="info-box-number">5</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-administrator-->

        </div>
        <!-- /.div-row -->
        
        <!-- ----------------------------------------------------------------------- -->
        <!-- /. Informasi SPP ------------------------------------------------------ -->
        <!-- ----------------------------------------------------------------------- -->
        <!-- div-row -->
        <div class="row mb-4">
            
            <div class="col-md-6">
                <div class="callout callout-success">
                    <b>Unit SMK - Informasi Pembayaran SPP</b>
                </div>
            </div>

            <div class="col-md-6">
                <div class="callout callout-success">
                    <b>Unit SMA - Informasi Pembayaran SPP</b>
                </div>
            </div>
            <!-- /.col-informasi-spp -->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-wallet"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pemasukan</span>
                        <span class="info-box-number">Rp. 10.000.000,-</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-pemasukan-persemester -->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-money-check-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Tagihan</span>
                        <span class="info-box-number">Rp. 0,-</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-pengeluaran-persemester -->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-wallet"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pemasukan</span>
                        <span class="info-box-number">Rp. 10.000.000,-</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-pemasukan-persemester -->

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-coins"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Tagihan</span>
                        <span class="info-box-number">Rp. 0,-</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col-pengeluaran-persemester -->

        </div>
        <!-- /.div-row -->


        <!-- ----------------------------------------------------------------------- -->
        <!-- /. Informasi SPP - Data Perkelas -------------------------------------- -->
        <!-- ----------------------------------------------------------------------- -->
        <!-- div-row -->
        <div class="row">

            <div class="col-md-12">
                <div class="callout callout-success">
                    <b>Rincian Pembayaran SPP</b>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-sm-6">
                            <select name="unit" id="unit" class="form-control">
                                <option value="Semua Unit">Semua Unit</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="unit" id="unit" class="form-control">
                                <option value="Tahun Ajar">Tahun Ajar</option>
                            </select>
                        </div>
                        <div class="chart col-lg-12">
                          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 300px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-informasi-spp -->
            
            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Jurusan</th>
                                    <th>Nama Kelas</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Total Pembayaran</th>
                                    <th>Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                <tr>
                                    <td>Teknik Komputer Jaringan</td>
                                    <td>X-TKJ-1</td>
                                    <td>40 Siswa</td>
                                    <td>Rp. 10.000.000,-</td>
                                    <td>Rp. 0,-</td>
                                </tr>

                                                    </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <small>Last updated data on 2023-01-01, 20:30 WIB</small>
                    </div>
                    <!-- /.card-footer -->

                </div>
                <!-- /.card -->

            </div>
            <!-- /.col-md-12 -->

        </div>
        <!-- /.div-row -->	
    </div>
  </section>
@endsection