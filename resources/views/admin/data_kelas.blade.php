@extends('layout.template_admin')

@section('title', 'Kelola data kelas')
@section('mainContent')

  @include('depedensi.admin.data_kelas')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Kelas</h1>
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
        <h3 class="card-title text-muted">Data Kelas SMK Triguna Utama</h3>
      </div>
    </div>
  </div>
</section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card-header -->
          <div class="card">
            <div class="card-body">
                  <div class="row">
                    <a href="{{ url('dashboard/create') }}" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Tambah Data</a>
                    <a href="{{ url('dashboard/export_excel') }}" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Export Data</a>
                    <a href="" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Import Data</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Kelas</th>
                        <th>Nama Jurusan</th>
                        <th>Status Data</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
          </div>
        </div>
      </div>
  </section>
@endsection