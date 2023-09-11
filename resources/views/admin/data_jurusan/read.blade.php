@extends('layout.template_admin')

@section('title', 'Kelola data jurusan')
@section('mainContent')

  @include('depedensi.admin.data_jurusan.read')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data jurusan</h1>
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
    <div class="col-md-12">
      <div class="callout callout-success">
          <b>Data jurusan SMK Triguna Utama</b>
      </div>
    </div>
  </div>
</section>

</section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card-header -->
          <div class="card">
            <div class="card-body">
                  <div class="row">
                    <a href="{{ route('admin.data_jurusan_create') }}" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Tambah Data</a>
                    <a href="{{ "" }}" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Export Data</a>
                    <a href="" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Import Data</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Jurusan</th>
                        <th>Singkatan</th>
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