@extends('layout.template_admin')

@section('title', 'Kelola data jurusan')
@section('mainContent')

  @include('depedensi.admin.data_jurusan.read')
  <section class="content">
    <div class="col-md-12">
      <div class="callout callout-success">
          <b>Data jurusan SMK Triguna Utama</b>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card-header -->
          <div class="card">
            <div class="card-body">
                  <div class="row">
                    <a href="{{ route('admin.data_jurusan_create') }}" class="btn btn-outline-primary p-2 ml-2">Tambah Data</a>
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