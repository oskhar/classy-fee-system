@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')

  @include('depedensi.admin.data_siswa.detail')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('') }}">Dashboard</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<section class="content">
  <div class="container-fluid">
    <div class="card card-outline-left">
      <div class="card-primary p-4">
        <h3 class="card-title text-muted">Data Siswa SMK Triguna Utama</h3>
      </div>
    </div>
  </div>
</section>
  <section class="content">
    <div class="container-fluid">

    <div class="card">
      <div class="card-body p-5 list-group list-group-unbordered">
          <h3 id="nama_siswa" class=""><strong>Nama Siswa:</strong> <span id="isi" class="float-right"></span></h3>
          <p id="nis" class="list-group-item"><strong>NIS:</strong> <span id="isi" class="float-right"></span></p>
          <p id="nisn" class="list-group-item"><strong>NISN:</strong> <span id="isi" class="float-right"></span></p>
          <p id="agama" class="list-group-item"><strong>Agama:</strong> <span id="isi" class="float-right"></span></p>
          <p id="tempat_lahir" class="list-group-item"><strong>Tempat Lahir:</strong> <span id="isi" class="float-right"></span></p>
          <p id="tanggal_lahir" class="list-group-item"><strong>Tanggal Lahir:</strong> <span id="isi" class="float-right"></span></p>
          <p id="jenis_kelamin" class="list-group-item"><strong>Jenis Kelamin:</strong> <span id="isi" class="float-right"></span></p>
          <p id="alamat" class="list-group-item"><strong>Alamat:</strong> <span id="isi" class="float-right"></span></p>
          <p id="nama_ayah" class="list-group-item"><strong>Nama Ayah:</strong> <span id="isi" class="float-right"></span></p>
          <p id="pekerjaan_ayah" class="list-group-item"><strong>Pekerjaan Ayah:</strong> <span id="isi" class="float-right"></span></p>
          <p id="penghasilan_ayah" class="list-group-item"><strong>Penghasilan Ayah:</strong> <span id="isi" class="float-right"></span></p>
          <p id="nama_ibu" class="list-group-item"><strong>Nama Ibu:</strong> <span id="isi" class="float-right"></span></p>
          <p id="pekerjaan_ibu" class="list-group-item"><strong>Pekerjaan Ibu:</strong> <span id="isi" class="float-right"></span></p>
          <p id="penghasilan_ibu" class="list-group-item"><strong>Penghasilan Ibu:</strong> <span id="isi" class="float-right"></span></p>
          <p id="telp_rumah" class="list-group-item"><strong>No Telepon Rumah:</strong> <span id="isi" class="float-right"></span></p>
          <p id="status_data" class="list-group-item"><strong>Status Data:</strong> <span id="isi" class="float-right"></span></p>
      </div>
  </div>
    </div>
  </section>
  @endsection