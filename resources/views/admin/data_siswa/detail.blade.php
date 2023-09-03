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
    </div>
  </section>
  @endsection