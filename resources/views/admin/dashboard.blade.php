@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')
@include('depedensi.admin.dashboard')
<section class="content">
    <div class="container-fluid">
        <!-- ----------------------------------------------------------------------- -->
        <!-- /. div-welcome -------------------------------------------------------- -->
        <!-- ----------------------------------------------------------------------- -->
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    Selamat Datang Adminstrator, Anda login saat ini tanggal 01 Januari 2023 pukul 07.00 WIB
                </div>
                <!-- /.div-alert -->
            </div>
            <!-- /.div-col -->
        </div>
        <!-- /.div-row -->

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="text-dark">SMA-SMK Triguna Utama Syarif Hidayatullah</h1>
                    <p class="lead">
                        Jl. Ir. H. Juanda Km. 2 Ciputat Timur, Tangerang Selatan, 15412 <br>
                        Telp. 74707543, Fax. 74707543,
                    </p>
                </div>
            </div>
            <!-- /.div-col -->
        </div>
        <!-- /.div-row -->

        <!-- ----------------------------------------------------------------------- -->
        <!-- /. Informasi Umum Aplikasi -------------------------------------------- -->
        <!-- ----------------------------------------------------------------------- -->
        <div class="row mb-2">

            <div class="col-md-12">
                <div class="callout callout-success">
                    <p>Informasi Umum Aplikasi</p>
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
    </div>
</section>
@endsection